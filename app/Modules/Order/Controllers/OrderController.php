<?php

namespace App\Modules\Order\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Order\Models\Order;

class OrderController extends Controller
{

    public function showOrders()
    {
     
        return view('Order::showOrders', ['orders' => Order::with('store')->where('status', '<', 13)->get()]);

    }
    public function showAddOrder()
    {
        return view('Order::addOrder', ['lastOrder' => Order::count() + 1]);

    }

    public function showUpdateOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            return view('Order::updateOrder', ['order' => $order ,'history' => $order->histories->first()]);

        }
        return view('General::notFound');

    }

    public function handleDeleteOrder($id)
    {

        $order = Order::find($id);
        if ($order) {
            $order->delete();
            alert()->success('Succés!', 'La commande a été supprimée avec succés !')->persistent('Femer');
            return redirect()->route('showOrders');
        }
        return view('General::notFound');
    }

    public function showOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            return view('Order::showOrder', ['order' => $order]);

        }
        return view('General::notFound');

    }

    public function showUpdateStatusOrder($id)
    {
        $order = Order::find($id);
        if ($order) {

            return view('Order::showUpdateStatusOrder', ['order' => $order,'history' => $order->histories->last()]);

        }
        return view('General::notFound');

    }

    public function showOrderPreparedProducts($id)
    {
        $order = Order::find($id);
        if ($order) {
            return view('Order::showOrderPreparedProducts', ['order' => $order]);

        }
        return view('General::notFound');

    }
    public function handleArchiveOrder($id)
    {

        $order = Order::find($id);
        if ($order) {
            $order->update(['status' => 13]);
            alert()->success('Succés!', 'La commande a été archivée')->persistent('Fermer');
            return redirect()->route('showOrders');

        }
        return view('General::notFound');

    }

    public function showUpdateDeliveryOrder($id)
    {
        $order = Order::find($id);
        if ($order) {

            return view('Order::updateDeliveryOrder', ['order' => $order, 'history' => $order->histories->last()]);

        }
        return view('General::notFound');

    }

}
