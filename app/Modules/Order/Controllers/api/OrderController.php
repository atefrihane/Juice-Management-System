<?php

namespace App\Modules\Order\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderHistory;
use App\Modules\Warehouse\Models\Warehouse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function handleSaveOrder(Request $request)
    {
        $checkOrder = Order::where('code', $request->code)->first();
        if (!$checkOrder) {
            $order = Order::create([
                'code' => $request->code,
                'status' => $request->status,
                'total' => $request->total_order,
                'store_id' => $request->store_id,
              
            ]);

            if ($request->input('ordered_products')) {
                foreach ($request->input('ordered_products') as $ordered) {
                    $order->products()->attach($ordered['product_id'], [
                        'package' => $ordered['packing'],
                        'unit' => $ordered['unit'],
                    ]);

                }
            }
            OrderHistory::create([
                'action' => 'Création',
                'order_id' => $order->id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,
            ]);
            return response()->json(['status' => 200]);

        }

        return response()->json(['status' => 400]);

    }
    public function showOrder($id)
    {

        $order = Order::find($id);

        if ($order) {
            $ordered_products = $order->products()->withPivot('package', 'unit')->get();

            $order_history = OrderHistory::with('user')->where('order_id', $order->id)->get();
            $prepared_products_as_object = $order->productwarehouses()->with('product', 'warehouse')->get()->groupBy('product.id');

            // convert object of arrays -> array of arrays :(
            $prepared_products = array();

            foreach ($prepared_products_as_object as $prepared) {
                array_push($prepared_products, (object) $prepared);
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
                'status' => $request->status
            ]);
            foreach ($request->custom_ordered as $custom) {
                $checkProduct = $order->products()->where('product_id', $custom['product_id'])->first();

                if ($checkProduct) {
                    $order->products()->updateExistingPivot($custom['product_id'], ['package' => $custom['package'], 'unit' => $custom['unit']]);

                } else {
                    $order->products()->attach($custom['product_id'], ['package' => $custom['package'], 'unit' => $custom['unit']]);
                }

            }
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
                    'action' => 'Etat vers : '.$request->input('new_status_text'),
                    'comment' => $request->comment
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
            if ($order->productwarehouses->count() == 0) {
                foreach ($request->final_prepared as $final) {
                    foreach ($final['prepared_products'] as $prepared) {

                        if (isset($prepared['pivot']['quantity'])) {
                            $order->productwarehouses()->attach($prepared['id'], [
                                'quantity' => $prepared['pivot']['quantity'],
                            ]);

                            $getWarehouse = Warehouse::where('designation', $prepared['warehouse']['designation'])->first();
                            $getStock = $getWarehouse->products()->where('product_warehouse.id', $prepared['id'])->first();
                            $getStock->pivot->quantity -= $prepared['pivot']['quantity'];
                            $getStock->pivot->save();
                        }

                    }

                }

            } else {

                foreach ($request->final_prepared as $final) {

                    foreach ($final['prepared_products'] as $prepared) {

                        $checkPrepare = $order->productwarehouses()->wherePivot('product_warehouse_id', $prepared['id'])->first();

                        if ($checkPrepare) {

                            if (isset($prepared['pivot']['quantity'])) {
                                if ($prepared['pivot']['quantity'] > $checkPrepare->pivot->quantity) {

                                    $difference = $prepared['pivot']['quantity'] - $checkPrepare->pivot->quantity;

                                    $getWarehouse = Warehouse::where('designation', $prepared['warehouse']['designation'])->first();
                                    $getStock = $getWarehouse->products()->where('product_warehouse.id', $checkPrepare->pivot->product_warehouse_id)->first();

                                    $getStock->pivot->quantity -= $difference;
                                    $getStock->pivot->save();
                                    $checkPrepare->pivot->quantity = $prepared['pivot']['quantity'];
                                    $checkPrepare->pivot->save();

                                }
                                if ($prepared['pivot']['quantity'] < $checkPrepare->pivot->quantity) {

                                    $difference = $checkPrepare->pivot->quantity - $prepared['pivot']['quantity'];
                                    $getWarehouse = Warehouse::where('designation', $prepared['warehouse']['designation'])->first();
                                    $getStock = $getWarehouse->products()->where('product_warehouse.id', $checkPrepare->pivot->product_warehouse_id)->first();
                                    $getStock->pivot->quantity += $difference;
                                    $getStock->pivot->save();
                                    $checkPrepare->pivot->quantity = $prepared['pivot']['quantity'];
                                    $checkPrepare->pivot->save();

                                }
                            } else {

                                $checkItem = $order->productwarehouses()->wherePivot('product_warehouse_id', $prepared['id'])->first();

                                if ($checkItem) {

                                    $checkItem->quantity += $checkItem->pivot->quantity;
                                    $checkItem->save();
                                    $order->productwarehouses()->detach($prepared['id']);

                                }

                            }

                        } else {
                            if (isset($prepared['pivot']['quantity'])) {
                                $order->productwarehouses()->attach($prepared['id'], [
                                    'quantity' => $prepared['pivot']['quantity'],
                                ]);

                                $getWarehouse = Warehouse::where('designation', $prepared['warehouse']['designation'])->first();
                                $getStock = $getWarehouse->products()->where('product_warehouse.id', $prepared['id'])->first();
                                $getStock->pivot->quantity -= $prepared['pivot']['quantity'];
                                $getStock->pivot->save();
                            }
                        }

                    }

                }
            }
            OrderHistory::create([
                'action' => 'Modification de la préparation',
                'order_id' => $order->id,
                'user_id' => $request->user_id,
                'comment' => $request->comment
            ]);

            return true;
        }
        return false;

    }

    public function handleOrderPreparedProducts($id, Request $request)
    {
        $checkPreparation = $this->handlePreparation($id, $request);
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
                    'comment' => $request->comment

                ]);
                return response()->json(['status' => 200]);

            } else {
                $checkPreparation = $this->handlePreparation($id, $request);

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
                        foreach ($request->balance as $balance) {
                   

                            $balanceOrder->products()->attach($balance['product_id'], [
                              'unit' => $balance['qty'],
                             'package' => ceil($balance['packing']/$balance['qty'])
                             
                             ]);
                        }

                    }
                    $order->update([
                        'status' => $request->new_status,
                    ]);

                    OrderHistory::create([
                        'action' => 'Etat vers : Préparée',
                        'user_id' => $request->user_id,
                        'order_id' => $id,
                        'comment' => $request->comment

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

}
