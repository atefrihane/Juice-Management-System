<?php

namespace App\Modules\Warehouse\Controllers;

use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{

    public function showWarehouseProducts()
    {
        return view('Warehouse::showWarehouseProducts');
    }

    public function showWarehouses()
    {
        return view('Warehouse::showWarehouses');
    }
    public function showAddProductQuantity()
    {

        return view('Warehouse::showAddProductQuantity');
    }

    public function showAddWarehouse()
    {
        return view('Warehouse::showAddWarehouse');

    }

    public function showWarehouseDetail()
    {
        return view('Warehouse::showWarehouseDetail');

    }
}
