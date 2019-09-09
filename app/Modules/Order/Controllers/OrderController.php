<?php

namespace App\Modules\Order\Controllers;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function showOrders()
    {
        return view('Order::showOrders');

    }
    public function showAddOrder()
    {
        return view('Order::addOrder');

    }
}
