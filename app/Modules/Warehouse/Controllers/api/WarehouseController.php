<?php

namespace App\Modules\Warehouse\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Warehouse\Models\Warehouse;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    public function handleGetWarehouseProducts($id)
    {
        $checkWarehouse = Warehouse::find($id);
        if (!$checkWarehouse) {
            return response()->json(['status' => 404]);
        }
        return response()->json(['status' => 200, 'warehouseProducts' => $checkWarehouse->products]);

    }

    public function handleAddWarehouseProduct(Request $request)
    {
        if (
         !$request->input('productId') ||
         !$request->input('warehouseId')  ||
         !$request->input('packing') ||
         !$request->input('quantity') ||
         !$request->input('creationDate') ||
         !$request->input('expirationDate') )
         {
            return response()->json(['status' => 400]);

        }
        $checkProduct = Product::find($request->input('productId'));

        if (!$checkProduct) {
            return response()->json(['status' => 404, 'warehouse' => 'Product not found']);

        }
        $checkWarehouse = Warehouse::find($request->input('warehouseId'));
        if (!$checkWarehouse) {
            return response()->json(['status' => 404, 'warehouse' => 'Warehouse not found']);

        }

        $checkWarehouse->products()->attach($request->input('productId'),[
            'packing' => $request->input('packing'),
            'quantity' => $request->input('quantity'),
            'creation_date' => $request->input('creationDate'),
            'expiration_date' => $request->input('expirationDate'),
            ]);
        return response()->json(['status' => 200]);

    }

}
