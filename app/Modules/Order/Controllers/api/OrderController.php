<?php

namespace App\Modules\Order\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderHistory;
use App\Modules\Order\Models\OrderPrepare;
use App\Modules\Product\Models\ProductWarehouse;
use App\Modules\Store\Models\Store;
use App\Modules\User\Models\User;
use DB;
use function _\findIndex;
use function _\remove;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function handleSaveOrder(Request $request)
    {
        if (!$request->filled('code') ||
            !$request->filled('status') ||
            !$request->filled('ordered_products') ||
            !$request->filled('user_id') ||
            !$request->filled('store_id') ||
            empty($request->input('ordered_products'))) {
            return response()->json(['status' => 400]);
        }

        $request->has('admin') ? $statusList = [0, 1, 2] : $statusList = [0, 1];
        if (!in_array($request->input('status'), $statusList)) {
            return response()->json(['status' => 404, 'orderStatus' => 'Wrong status']);
        }
        $checkCount = Order::count();
        if ($checkCount > 0) {
            $code = Order::all()->last()->id + 1;
        } else {
            $code = 1;
        }
        $orderCode = $request->code . '-' . $code;

        $checkOrderCode = Order::where('code', $orderCode)->first();
        if ($checkOrderCode) {
            return response()->json([
                'status' => 404,
                'orderCode' => 'Dupplicated order code',
            ]);
        }

        $order = Order::create([
            'code' => $orderCode,
            'status' => $request->status,
            'store_id' => $request->store_id,
            'arrival_date_wished' => $request->arrival_date_wished,

        ]);
        $newProducts = [];
        $customisedProduct = [];
        if ($request->input('ordered_products')) {
            foreach ($request->input('ordered_products') as $ordered) {
                if (!array_key_exists('packing', $ordered) ||
                    !array_key_exists('unit', $ordered) ||
                    !array_key_exists('public_price', $ordered) ||
                    !array_key_exists('tva', $ordered) ||
                    !array_key_exists('product_id', $ordered)
                ) {
                    return response()->json(['status' => 404, 'ordered_products' => 'Wrong keys']);
                }
                $customisedProduct = [
                    'package' => (int) $ordered['packing'],
                    'unit' => (int) $ordered['unit'],
                    'custom_price' => $ordered['public_price'],
                    'custom_tva' => $ordered['tva'],
                    'order_id' => $order->id,
                    'product_id' => $ordered['product_id'],
                ];
                array_push($newProducts, $customisedProduct);
            }

        }

        DB::table('order_product')->insert($newProducts);

        OrderHistory::create([
            'action' => 'Création',
            'order_id' => $order->id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,
        ]);
        return response()->json(['status' => 200]);

    }

    public function showOrder($id)
    {

        $order = Order::find($id);

        if ($order) {
            $ordered_products = $order->products()->withPivot('package', 'unit', 'custom_price', 'custom_tva')->get();

            $order_history = OrderHistory::with('user')
                ->where('order_id', $order->id)
                ->orderBy('created_at', 'DESC')
                ->get();
            $prepared_products_as_object = $order->productwarehouses()->with('product', 'warehouse')->get()->groupBy('product.id');
            $store = Store::with('country', 'city', 'zipcode')->where('id', $order->store_id)->first();

            // convert object of arrays -> array of arrays :(
            $prepared_products = array();

            foreach ($prepared_products_as_object as $prepared) {
                array_push($prepared_products, (object) $prepared);
            }

            $invoice = DB::table('order_prepare')
                ->where('order_id', $order->id)
                ->join('product_warehouse', 'product_warehouse.id', '=', 'order_prepare.product_warehouse_id')
                ->join('products', 'products.id', '=', 'product_warehouse.product_id')
                ->select('products.nom as name', 'products.id as product_id',
                    'products.tva', 'products.public_price', 'order_prepare.order_id',
                    DB::raw('sum(order_prepare.quantity) as sum'),
                    DB::raw(' 0  as total')
                )
                ->groupBy('product_warehouse.product_id')
                ->get()->toArray();

            //update TVA  + Public Price
            foreach ($invoice as $invoiceItem) {
                foreach ($ordered_products as $ordered) {
                    if (($invoiceItem->order_id == $ordered->pivot->order_id) && ($invoiceItem->product_id == $ordered->pivot->product_id)) {

                        $invoiceItem->tva = $ordered->pivot->custom_tva;
                        $invoiceItem->public_price = $ordered->pivot->custom_price;

                    }
                }

            }

            return response()->json([
                'status' => 200,
                'order' => $order,
                'prepared_products' => $prepared_products,
                'ordered_products' => $ordered_products,
                'order_history' => $order_history,
                'preparator' => $order->preparator,
                'delivery_man' => $order->delivery,
                'parent' => $order->parent,
                'store' => $store,
                'invoice' => $invoice,
            ]);

        }

        return response()->json(['status' => 404]);

    }

    public function handleDeleteProduct(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->products()->detach($request->product_id);
            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404]);

    }
    public function handleUpdateProduct(Request $request, $id)
    {
        if (!$request->filled('code') ||
            !$request->filled('status') ||
            !$request->filled('custom_ordered') ||
            !$request->filled('user_id') ||
            !$request->filled('store_id') ||
            empty($request->input('custom_ordered'))) {
            return response()->json(['status' => 400]);
        }

        $request->has('admin') ? $statusList = [0, 1, 2] : $statusList = [0, 1];
        if (!in_array($request->input('status'), $statusList)) {
            return response()->json(['status' => 404, 'orderStatus' => 'Wrong status']);
        }

        $order = Order::find($id);

        if ($order) {
            $request->has('admin') ? $statusList = [0, 1, 2] : $statusList = [0, 1];
            $order->update([
                'store_id' => $request->store_id,
                'status' => $request->status,
                'arrival_date_wished' => $request->arrival_date_wished,
            ]);

            $products_keys = array_pluck($request->custom_ordered, 'product_id');

            $checkProducts = DB::table('order_product')->whereIn('product_id', $products_keys)
                ->where('order_id', $order->id)
                ->get();

            $newProducts = [];
            $customisedProduct = [];

            foreach ($request->custom_ordered as $custom) {

                if (!array_key_exists('package', $custom) ||
                    !array_key_exists('unit', $custom) ||
                    !array_key_exists('public_price', $custom) ||
                    !array_key_exists('tva', $custom) ||
                    !array_key_exists('product_id', $custom)
                ) {
                    return response()->json(['status' => 404, 'ordered_products' => 'Wrong keys']);
                }

                $customisedProduct = [
                    'package' => (int) $custom['package'],
                    'unit' => (int) $custom['unit'],
                    'custom_price' => $custom['public_price'],
                    'custom_tva' => $custom['tva'],
                    'order_id' => $order->id,
                    'product_id' => $custom['product_id'],
                ];

                array_push($newProducts, $customisedProduct);

            }

            DB::table('order_product')->where('order_id', $order->id)->delete();
            DB::table('order_product')->insert($newProducts);

            // foreach ($request->custom_ordered as $custom) {

            //     $checkProduct = DB::table('order_product')->where('product_id', $custom['product_id'])
            //         ->where('order_id', $order->id)
            //         ->first();

            //     if ($checkProduct) {
            //         DB::table('order_product')->where('product_id', $custom['product_id'])
            //             ->where('order_id', $order->id)
            //             ->update([
            //                 'package' => $custom['package'],
            //                 'unit' => $custom['unit'],
            //             ]);

            //     } else {
            //         $order->products()->attach($custom['product_id'], ['package' => $custom['package'], 'unit' => $custom['unit']]);
            //     }

            // }

            OrderHistory::create([
                'action' => $request->status == 0 ? 'Modification' : 'Etat vers : A préparer',
                'user_id' => $request->user_id,
                'order_id' => $order->id,
                'comment' => $request->comment,
            ]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);

    }

    public function handleUpdateOrderToPrepare(Request $request, $id)
    {

        $order = Order::find($id);
        if ($order) {

            if ($request->input('new_status') &&
                $request->input('new_status_text') &&
                $request->input('user_id')
            ) {
                $order->update([
                    'status' => $request->input('new_status'),
                    'preparator_id' => $request->input('preparator_id'),

                ]);
                OrderHistory::create([
                    'order_id' => $order->id,
                    'user_id' => $request->user_id,
                    'action' => 'Etat vers : ' . $request->input('new_status_text'),
                    'comment' => $request->comment,
                ]);

                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 400]);

            }

        }
        return response()->json(['status' => 404]);

    }

    public function handlePreparation($id, $request)
    {
        $order = Order::find($id);

        if ($order) {

            $oldProducts = DB::table('order_prepare')->where('order_id', $id)->get()->toArray();
            $newProducts = []; //array of filtered new products
            $array = [];
            // create a custom array for bulk insert
            foreach ($request->final_prepared as $final) {

                foreach ($final['prepared_products'] as $prepared) {
                    if ($prepared['pivot']['quantity']) {
                        $array = [
                            'quantity' => $prepared['pivot']['quantity'],
                            'order_id' => $order->id,
                            'product_warehouse_id' => $prepared['id'],
                        ];
                        array_push($newProducts, $array);

                    } else {
                        $array = [
                            'quantity' => 0,
                            'order_id' => $order->id,
                            'product_warehouse_id' => $prepared['id'],
                        ];
                        array_push($newProducts, $array);

                    }

                }

            }

            $allStock = DB::table('product_warehouse')->get();

            //update stock items in the warehouses

            $newStock = [];
            $unavailableStock = []; // if there is no more available quantity in a specific warehouse
            $newArray = [];

            // compare quantity in stock with upcomping one

            if (count($oldProducts) > 0) {

                //Check for old prepared values and update stock if necessary
                foreach ($allStock as $stock) {
                    foreach ($newProducts as $newProduct) {
                        //Check if the upcoming product already exists in the prepared products
                        $index = findIndex($oldProducts, ['product_warehouse_id' => $newProduct['product_warehouse_id']]);

                        if ($stock->id == $newProduct['product_warehouse_id'] && $index > -1) {

                            if ($stock->quantity + $oldProducts[$index]->quantity >= $newProduct['quantity']) {

                                if ($newProduct['quantity'] > $oldProducts[$index]->quantity) {
                                    $newArray = [
                                        'quantity' => $stock->quantity + $oldProducts[$index]->quantity - $newProduct['quantity'],
                                        'id' => $newProduct['product_warehouse_id'],

                                    ];
                                    array_push($newStock, $newArray);

                                } else if ($newProduct['quantity'] < $oldProducts[$index]->quantity) {
                                    $newArray = [
                                        'quantity' => $stock->quantity + $oldProducts[$index]->quantity - $newProduct['quantity'],
                                        'id' => $newProduct['product_warehouse_id'],

                                    ];
                                    array_push($newStock, $newArray);

                                }

                            } else {
                                $newArray = [
                                    'quantity' => $stock->quantity,
                                    'old_quantity' => $oldProducts[$index]->quantity,
                                    'id' => $newProduct['product_warehouse_id'],

                                ];

                                array_push($unavailableStock, $newArray);

                            }
                        } else if ($stock->id == $newProduct['product_warehouse_id'] && $index == -1) {

                            foreach ($allStock as $stock) {

                                if ($stock->id == $newProduct['product_warehouse_id']) {

                                    if ($stock->quantity >= $newProduct['quantity']) {
                                        $newArray = [
                                            'quantity' => $stock->quantity - $newProduct['quantity'],
                                            'id' => $newProduct['product_warehouse_id'],

                                        ];

                                        array_push($newStock, $newArray);

                                    } else {
                                        $newArray = [
                                            'quantity' => $stock->quantity,
                                            'old_quantity' => $newProduct['quantity'],
                                            'id' => $newProduct['product_warehouse_id'],

                                        ];

                                        array_push($unavailableStock, $newArray);

                                    }

                                }

                            }

                        }

                    }

                }

                //Update Stock without checking on old values ( first preparation)
            } else {
                foreach ($allStock as $stock) {
                    foreach ($newProducts as $newProduct) {
                        if ($stock->id == $newProduct['product_warehouse_id']) {
                            if ($stock->quantity >= $newProduct['quantity']) {
                                $newArray = [
                                    'quantity' => $stock->quantity - $newProduct['quantity'],
                                    'id' => $newProduct['product_warehouse_id'],

                                ];

                                array_push($newStock, $newArray);

                            } else if ($stock->quantity < $newProduct['quantity']) {
                                $newArray = [
                                    'quantity' => $stock->quantity,
                                    'old_quantity' => $newProduct['quantity'],
                                    'id' => $newProduct['product_warehouse_id'],

                                ];

                                array_push($unavailableStock, $newArray);

                            }

                        }
                    }
                }

            }

            //returns array of unsufficient data
            if (count($unavailableStock) > 0) {

                return $unavailableStock;

            }

            //bulk update (Stock )
            $stockInstance = new ProductWarehouse;
            $index = 'id';

            \Batch::update($stockInstance, $newStock, $index);
            $newProducts = remove($newProducts, function ($newProduct) {return $newProduct['quantity'] > 0;});
            //add new prepared products
            DB::table('order_prepare')->where('order_id', $id)->delete();
            DB::table('order_prepare')->insert($newProducts);

            OrderHistory::create([
                'action' => 'Modification de la préparation',
                'order_id' => $order->id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,
            ]);

            return true;
        }
        return false;

    }

    public function handleOrderPreparedProducts($id, Request $request)
    {
        $checkPreparation = $this->handlePreparation($id, $request);
        if ($checkPreparation) {

            if (is_array($checkPreparation)) {
                return response()->json(['status' => 400, 'unavailableStock' => $checkPreparation]);

            }
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);

    }

    public function handleDeleteOrderPrepare($id, Request $request)
    {

        $order = Order::find($id);

        if ($order) {
            foreach ($request->final_prepared['prepared_products'] as $prepared) {
                if ($prepared['pivot']['quantity']) {
                    $checkItem = $order->productwarehouses()->wherePivot('product_warehouse_id', $prepared['id'])->first();

                    if ($checkItem) {

                        $productWarehouseIncrementStock = $order->productwarehouses()->where('product_warehouse.id', $prepared['id'])->first();

                        $productWarehouseIncrementStock->quantity += $prepared['pivot']['quantity'];

                        $productWarehouseIncrementStock->save();

                        $order->productwarehouses()->detach($prepared['id']);

                    }

                }

            }
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 404]);

    }

    public function handleSubmitOrderInPrepare($id, Request $request)
    {

        $order = Order::find($id);

        if ($order) {

            if ($request->new_status == 12) {
                $oldStocks = [];
                $newStock = [];
                $array = [];

                foreach ($request->final_prepared as $final) {

                    foreach ($final['prepared_products'] as $prepared) {
                        if (isset($prepared['pivot']['quantity'])) {
                            $array = [
                                'id' => $prepared['pivot']['product_warehouse_id'],
                                'quantity' => $prepared['pivot']['quantity'],

                            ];
                            array_push($oldStocks, $array);
                        }

                    }
                }
                // check if there is already prepared products to detach them
                if (count($oldStocks) > 0) {
                    $allStock = DB::table('product_warehouse')->get();

                    foreach ($allStock as $stock) {
                        foreach ($oldStocks as $oldStock) {
                            if ($stock->id == $oldStock['id']) {
                                $array = [
                                    'id' => $stock->id,
                                    'quantity' => $stock->quantity + $oldStock['quantity'],

                                ];

                                array_push($newStock, $array);

                            }
                        }

                    }

                    //Bulk update
                    $stockInstance = new ProductWarehouse;
                    $index = 'id';

                    \Batch::update($stockInstance, $newStock, $index);

                }

                $order->update([
                    'status' => $request->new_status,
                ]);

                OrderHistory::create([
                    'action' => 'Etat vers : Annulée',
                    'user_id' => $request->user_id,
                    'order_id' => $id,
                    'comment' => $request->comment,

                ]);
                return response()->json(['status' => 200]);

            } else {

                $checkPreparation = $this->handlePreparation($id, $request);

                if ($checkPreparation) {

                    if (is_array($checkPreparation)) {
                        return response()->json(['status' => 400, 'unavailableStock' => $checkPreparation]);

                    } else {
                        if ($request->balance) {

                            $balanceOrder = Order::create([
                                'code' => $order->code . '-relq',
                                'status' => 2,
                                'store_id' => $order->store_id,
                                'parent_id' => $order->id,
                            ]);
                            $newProducts = [];
                            $array = [];

                            foreach ($request->balance as $balance) {
                                $array = [
                                    'order_id' => $balanceOrder->id,
                                    'product_id' => $balance['product_id'],
                                    'package' => ceil($balance['packing'] / $balance['qty']),
                                    'unit' => $balance['qty'],
                                    'custom_price' => $balance['public_price'],
                                    'custom_tva' => $balance['tva'],
                                ];
                                array_push($newProducts, $array);

                            }

                            DB::table('order_product')->insert($newProducts);

                            OrderHistory::create([
                                'action' => 'Création',
                                'user_id' => $request->user_id,
                                'order_id' => $balanceOrder->id,
                                'comment' => $request->comment,

                            ]);

                        }
                        $order->update([
                            'status' => $request->new_status,
                        ]);

                        OrderHistory::create([
                            'action' => 'Etat vers : Préparée',
                            'user_id' => $request->user_id,
                            'order_id' => $id,
                            'comment' => $request->comment,

                        ]);
                        return response()->json(['status' => 200]);

                    }

                }
                return response()->json(['status' => 404]);

            }

        }

    }
    public function cancelOrder($request, $order)
    { //check for prepared products before cancel order
        $preparedProducts = DB::table('order_prepare')->where('order_id', $order->id)->get();

        if ($preparedProducts) {
            $updatedStock = [];
            $array = [];

            $allStock = DB::table('product_warehouse')->get();
            foreach ($allStock as $stock) {
                foreach ($preparedProducts as $prepared) {
                    if ($prepared->product_warehouse_id == $stock->id) {
                        $array = [
                            'id' => $stock->id,
                            'quantity' => $stock->quantity + $prepared->quantity,
                        ];
                        array_push($updatedStock, $array);
                    }
                }
            }
            $stockInstance = new ProductWarehouse;
            $index = 'id';

            \Batch::update($stockInstance, $updatedStock, $index);

        }
        $order->update(['status' => $request->new_status]);
        return true;

    }

    public function handleSubmitOrderAfterPrepare($id, Request $request)
    {

        $order = Order::find($id);

        if ($order) {
            if ($request->new_status == 12) {
                $cancel = $this->cancelOrder($request, $order);
                if ($cancel) {
                    return response()->json(['status' => 200, 'canceled' => true]);
                }

            } else {

                switch ($request->new_status) {
                    case (5):
                        $request->validate([
                            'carrier_mode' => 'required',
                            'delivery_man_id' => 'required',
                            'delivery_mode' => 'required',
                            'carton_number' => 'required|numeric|digits_between:1,6',
                            'palet_number' => 'required|numeric|digits_between:1,6',
                            'volume' => 'required|min:1|max:999999|digits_between:1,6',
                            'weight' => 'required|min:1|max:999999|digits_between:1,6',
                            'comment' => 'nullable|max:200',

                        ], [
                            'carrier_mode.required' => ' Transporteur est obligatoire',
                            'delivery_man_id.required' => ' Livreur  est obligatoire',
                            'delivery_man_id.required' => ' Livreur  est obligatoire',
                            'delivery_mode.required' => ' Mode de livraison est obligatoire',
                            'carton_number.required' => ' Nombre de cartons est obligatoire',
                            'carton_number.numeric' => ' Nombre de cartons n\'est pas valide',
                            'carton_number.digits_between' => '  Nombre de cartons n\'est pas valide',
                            'palet_number.required' => ' Nombre de palette est obligatoire',
                            'palet_number.numeric' => ' Nombre de palette n\'est pas valide',
                            'palet_number.digits_between' => '  Nombre de palette n\'est pas valide',
                            'volume.required' => ' Volume(m²) est obligatoire',
                            'volume.numeric' => ' Volume(m²) n\'est pas valide',
                            'volume.digits_between' => '  Volume(m²) n\'est pas valide',
                            'weight.required' => ' Poids(kg) est obligatoire',
                            'weight.numeric' => ' Poids(kg) n\'est pas valide',
                            'weight.digits_between' => '  Poids(kg) n\'est pas valide',
                            'comment.max' => '  Commentaire n\'est pas valide',

                        ]);
                        {
                            $order->update([
                                'status' => $request->new_status,
                                'carrier' => $request->carrier_mode,
                                'delivery_man_id' => $request->delivery_man_id,
                                'delivery_mode' => $request->delivery_mode,
                                'cartons_number' => $request->carton_number,
                                'pallets_number' => $request->palet_number,
                                'weight' => $request->weight,
                                'volume' => $request->volume,

                            ]);
                            OrderHistory::create([
                                'action' => 'Etat vers : A livrer',
                                'order_id' => $order->id,
                                'user_id' => $request->user_id,
                                'comment' => $request->comment,
                            ]);

                        }
                        break;

                    case (6):
                        {

                            $request->validate([

                                'comment' => 'nullable|max:200',

                            ], [

                                'comment.max' => '  Commentaire n\'est pas valide',

                            ]);
                            $order->update([
                                'status' => $request->new_status,
                                'estimated_arrival_date' => $request->date,
                                'estimated_arrival_time' => $request->time,

                            ]);
                            OrderHistory::create([
                                'action' => 'Etat vers : En cours de livraison',
                                'order_id' => $order->id,
                                'user_id' => $request->user_id,
                                'comment' => $request->comment,
                            ]);

                        }
                        break;
                    case (7):
                        {
                            $request->validate([

                                'comment' => 'nullable|max:200',

                            ], [

                                'comment.max' => '  Commentaire n\'est pas valide',

                            ]);

                            $order->update([
                                'status' => $request->new_status,
                                'arrival_date' => $request->date,
                                'arrival_time' => $request->time,

                            ]);
                            OrderHistory::create([
                                'action' => 'Etat vers : Livrée',
                                'order_id' => $order->id,
                                'user_id' => $request->user_id,
                                'comment' => $request->comment,
                            ]);

                        }
                        break;

                    case (8):
                        {
                            $request->validate([

                                'comment' => 'nullable|max:200',

                            ], [

                                'comment.max' => '  Commentaire n\'est pas valide',

                            ]);

                            $order->update([
                                'status' => $request->new_status,

                            ]);

                            if ($order->productwarehouses->count() > 0) {
                                foreach ($order->productwarehouses as $productwarehouse) {
                                    $order->store->products()->attach($productwarehouse->product_id, [
                                        'quantity' => $productwarehouse->quantity,
                                        'creation_date' => $productwarehouse->creation_date,
                                        'expiration_date' => $productwarehouse->expiration_date,

                                    ]);

                                }

                            }

                            OrderHistory::create([
                                'action' => 'Etat vers : A facturer',
                                'order_id' => $order->id,
                                'user_id' => $request->user_id,
                                'comment' => $request->comment,
                            ]);

                        }
                        break;

                    case (9):
                        {

                            $request->validate([

                                'comment' => 'nullable|max:200',

                            ], [

                                'comment.max' => '  Commentaire n\'est pas valide',

                            ]);

                            $order->update([
                                'status' => $request->new_status,

                            ]);
                            OrderHistory::create([
                                'action' => 'Etat vers : Facturée',
                                'order_id' => $order->id,
                                'user_id' => $request->user_id,
                                'comment' => $request->comment,
                            ]);

                        }
                        break;

                    case (10):
                        {

                            $request->validate([

                                'comment' => 'nullable|max:200',

                            ], [

                                'comment.max' => '  Commentaire n\'est pas valide',

                            ]);

                            $order->update([
                                'status' => $request->new_status,

                            ]);
                            OrderHistory::create([
                                'action' => 'Etat vers : A envoyer en comptabilité',
                                'order_id' => $order->id,
                                'user_id' => $request->user_id,
                                'comment' => $request->comment,
                            ]);

                        }
                        break;

                    case (11):
                        {

                            $request->validate([

                                'comment' => 'nullable|max:200',

                            ], [

                                'comment.max' => '  Commentaire n\'est pas valide',

                            ]);

                            $order->update([
                                'status' => $request->new_status,

                            ]);
                            OrderHistory::create([
                                'action' => 'Etat vers : Comptabilisée',
                                'order_id' => $order->id,
                                'user_id' => $request->user_id,
                                'comment' => $request->comment,
                            ]);

                        }
                        break;

                }

                return response()->json(['status' => 200, 'canceled' => false]);
            }

        }
        return response()->json(['status' => 404]);

    }

    public function handleUpdateHistory($id, Request $request)
    {

        $checkOrder = OrderHistory::find($id);
        if ($checkOrder) {
            $checkOrder->update(['comment' => $request->comment]);
            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404]);

    }

    public function handleUpdateDeliveryOrder($id, Request $request)
    {

        $request->validate([
            'carrier_mode' => 'required',
            'delivery_man_id' => 'required',
            'delivery_mode' => 'required',
            'carton_number' => 'required|numeric|digits_between:1,6',
            'palet_number' => 'required|numeric|digits_between:1,6',
            'volume' => 'required|min:1|max:999999|digits_between:1,6',
            'weight' => 'required|min:1|max:999999|digits_between:1,6',
            'comment' => 'nullable|max:200',

        ], [
            'carrier_mode.required' => ' Transporteur est obligatoire',
            'delivery_man_id.required' => ' Livreur  est obligatoire',
            'delivery_man_id.required' => ' Livreur  est obligatoire',
            'delivery_mode.required' => ' Mode de livraison est obligatoire',
            'carton_number.required' => ' Nombre de cartons est obligatoire',
            'carton_number.numeric' => ' Nombre de cartons n\'est pas valide',
            'carton_number.digits_between' => '  Nombre de cartons n\'est pas valide',
            'palet_number.required' => ' Nombre de palette est obligatoire',
            'palet_number.numeric' => ' Nombre de palette n\'est pas valide',
            'palet_number.digits_between' => '  Nombre de palette n\'est pas valide',
            'volume.required' => ' Volume(m²) est obligatoire',
            'volume.numeric' => ' Volume(m²) n\'est pas valide',
            'volume.digits_between' => '  Volume(m²) n\'est pas valide',
            'weight.required' => ' Poids(kg) est obligatoire',
            'weight.numeric' => ' Poids(kg) n\'est pas valide',
            'weight.digits_between' => '  Poids(kg) n\'est pas valide',
            'comment.max' => '  Commentaire n\'est pas valide',

        ]);

        $order = Order::find($id);
        if ($order) {

            $order->update([

                'carrier' => $request->carrier_mode,
                'delivery_man_id' => $request->delivery_man_id,
                'delivery_mode' => $request->delivery_mode,
                'cartons_number' => $request->carton_number,
                'pallets_number' => $request->palet_number,
                'weight' => $request->weight,
                'volume' => $request->volume,
                'estimated_arrival_date' => $request->estimated_arrival_date,
                'estimated_arrival_time' => $request->estimated_arrival_time,
                'arrival_date' => $request->arrival_date,
                'arrival_time' => $request->arrival_time,

            ]);
            OrderHistory::create([
                'action' => 'Modification de la livraison',
                'order_id' => $id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,

            ]);
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 404]);
    }

    public function showOrderPrepared($id)
    {

        $order = Order::find($id);
        if ($order) {

            return response()->json(['status' => 200, 'billed_products' => $order->productwarehouses()->with('product')->get()]);

        }
        return response()->json(['status' => 404]);
    }

    public function showOrderByStore($id)
    {
        $checkStore = Store::find($id);
        if ($checkStore) {
            $orders = $checkStore->orders()
                ->whereBetween('status', [0, 9])
                ->with(['products', 'histories.user', 'store.company'])
                ->get();

            return response()->json(['status' => 200, 'orders' => $orders]);
        }
        return response()->json(['status' => 404, 'Store' => 'Store not found']);
    }

    public function handleConfirmOrder($id, Request $request)
    {
        if (!$request->filled('delivered') ||
            !$request->filled('userId') ||
            !$request->filled('store_id')) {
            return response()->json(['status' => 400]);
        }
        $checkUser = User::find($request->input('userId'));
        if (!$checkUser) {
            return response()->json(['status' => 404, 'User' => 'User not found']);

        }
        if (!in_array($request->input('delivered'), [0, 1])) {
            return response()->json(['status' => 404, 'Delivered' => ' Wrong value']);
        }
        $checkOrder = Order::find($id);
        if ($checkOrder) {
            $checkOrder->update(['delivered' => $request->delivered]);
            if ($request->delivered == 1) {

                // get prepared products
                $preparedProducts = OrderPrepare::where('order_id', $checkOrder->id)
                    ->pluck('product_warehouse_id')
                    ->toArray();
                // add them in store stock
                if (!empty($preparedProducts)) {
                    $productWarehouses = ProductWarehouse::whereIn('id', $preparedProducts)->get();
                    $storeStock = [];
                    if (!empty($productWarehouses)) {
                        foreach ($productWarehouses as $productWarehouse) {
                            array_push($storeStock, [
                                'packing' => $productWarehouse->packing,
                                'quantity' => $productWarehouse->quantity,
                                'creation_date' => $productWarehouse->creation_date,
                                'expiration_date' => $productWarehouse->expiration_date,
                                'stock_display' => $productWarehouse->stock_display,
                                'packing_display' => $productWarehouse->packing_display,
                                'product_id' => $productWarehouse->product_id,
                                'store_id' => $request->store_id,
                            ]);

                        }
                        DB::table('store_products')->insert($storeStock);
                        OrderHistory::create([
                            'order_id' => $checkOrder->id,
                            'action' => 'Confirmation de la commande',
                            'user_id' => $request->input('userId'),
                        ]);
                        return response()->json(['status' => 200]);

                    }
                    return response()->json(['status' => 404, 'Products warehouse' => 'empty']);

                }
                return response()->json(['status' => 404, 'Prepared Products' => 'empty']);

            }

            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404, 'Order' => 'Order not found']);

    }

}
