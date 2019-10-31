<?php

namespace App\Modules\Order\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderHistory;
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
                'comment' => $request->comment,
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
                'action' => 'Sauvegarde',
                'order_id' => $order->id,
                'user_id' => $request->user_id,
            ]);
            return response()->json(['status' => 200]);

        }

        return response()->json(['status' => 400]);

    }
    public function showOrder($id)
    {
        $order = Order::find($id);

        // OrderProduct::where('order_id',$id)->with('product')->get();
        if ($order) {
            $ordered_products = $order->products()->withPivot('package', 'unit')->get();
            return response()->json(['status' => 200, 'order' => $order, 'ordered_products' => $ordered_products]);

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
                'comment' => $request->comment,
            ]);
            foreach ($request->custom_ordered as $custom) {
                $checkProduct = $order->products()->where('product_id', $custom['product_id'])->first();
                // dd($request->all());
                if ($checkProduct) {
                    $order->products()->updateExistingPivot($custom['product_id'], ['package' => $custom['package'], 'unit' => $custom['unit']]);

                } else {
                    $order->products()->attach($custom['product_id'], ['package' => $custom['package'], 'unit' => $custom['unit']]);
                }

            }
            OrderHistory::create([
                'action' => 'Mise à jour ',
                'user_id' => $request->user_id,
                'order_id'=>$order->id
            ]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);

    }

}
