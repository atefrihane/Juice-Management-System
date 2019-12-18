<?php

namespace App\Modules\Order\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderHistory;
use App\Modules\Product\Models\ProductWarehouse;
use App\Modules\Store\Models\Store;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function handleSaveOrder(Request $request)
    {

        $checkCount = Order::count();
        if ($checkCount > 0) {
            $code = Order::all()->last()->id + 1;
        } else {
            $code = 1;
        }
        $orderCode = $request->code . '-' . $code;

        $order = Order::create([
            'code' => $orderCode,
            'status' => $request->status,
            'total' => $request->total_order,
            'store_id' => $request->store_id,
            'arrival_date_wished' => $request->arrival_date_wished,

        ]);
        $newProducts = [];
        $customisedProduct = [];
        if ($request->input('ordered_products')) {
            foreach ($request->input('ordered_products') as $ordered) {

                $customisedProduct = [
                    'package' => (int) $ordered['packing'],
                    'unit' => (int) $ordered['unit'],
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
            $ordered_products = $order->products()->withPivot('package', 'unit')->get();

            $order_history = OrderHistory::with('user')->where('order_id', $order->id)->get();
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
                    'products.tva', 'products.public_price',
                    DB::raw('sum(order_prepare.quantity) as sum'),
                    DB::raw(' 0  as total')
                )
                ->groupBy('product_warehouse.product_id')
                ->get();

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

        $order = Order::find($id);
        if ($order) {

            $order->update([
                'store_id' => $request->store_id,
                'total' => $request->total_order,
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

                $customisedProduct = [
                    'package' => (int) $custom['package'],
                    'unit' => (int) $custom['unit'],
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
    public function handlePreparation($id, $request, $check)
    {
        $order = Order::find($id);

        if ($order) {
            if ($order->productwarehouses) {
                DB::table('order_prepare')->where('order_id', $id)->delete();

            }

            $newProducts = [];
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

                    }

                }

            }

            //add new prepared products
            DB::table('order_prepare')->insert($newProducts);

            //update stock items in the warehouses
            if ($check == 1) {

                $allStock = DB::table('product_warehouse')->get();
                $newStock = [];
                $newArray = [];

                foreach ($allStock as $stock) {

                    foreach ($newProducts as $newProduct) {
                        if ($stock->id == $newProduct['product_warehouse_id']) {

                            $newArray = [
                                'quantity' => $stock->quantity - $newProduct['quantity'],
                                'id' => $newProduct['product_warehouse_id'],

                            ];

                            array_push($newStock, $newArray);

                        }
                    }
                }
                //bulk update
                $stockInstance = new ProductWarehouse;
                $index = 'id';

                \Batch::update($stockInstance, $newStock, $index);

            }

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
    { // 0 =   add prepared products without updating warehouse stock //   1 =  vice versa
        $checkPreparation = $this->handlePreparation($id, $request, 0);
        if ($checkPreparation) {
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

                foreach ($request->final_prepared as $final) {
                    foreach ($final['prepared_products'] as $prepared) {

                        $productWarehouseIncrementStock = $order->productwarehouses()->where('product_warehouse.id', $prepared['id'])->first();
                        if ($prepared['pivot']['quantity']) {
                            $productWarehouseIncrementStock->quantity += $prepared['pivot']['quantity'];

                            $productWarehouseIncrementStock->save();
                        }

                        $order->productwarehouses()->detach($prepared['id']);

                    }
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
                $checkPreparation = $this->handlePreparation($id, $request, 1);

                if ($checkPreparation) {

                    if ($request->balance) {
                        $total = array_sum(array_column($request->balance, 'qty'));
                        $balanceOrder = Order::create([
                            'code' => $order->code . '-req',
                            'status' => 2,
                            'total' => $total,
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
                return response()->json(['status' => 404]);

            }

        }

    }
    public function cancelOrder($request, $order)
    {
        if ($order->productwarehouses) {
            foreach ($order->productwarehouses as $productwarehouse) {
                $productwarehouse->quantity += $productwarehouse->pivot->quantity;
                $productwarehouse->save();
                $order->productwarehouses()->detach($productwarehouse->id);
            }

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

}
