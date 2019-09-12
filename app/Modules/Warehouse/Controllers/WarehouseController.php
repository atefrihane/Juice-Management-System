<?php

namespace App\Modules\Warehouse\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use App\Modules\Warehouse\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    public function showWarehouseProducts()
    {
        return view('Warehouse::showWarehouseProducts');
    }

    public function showWarehouses()
    {
        $warehouses = Warehouse::all();
        return view('Warehouse::showWarehouses', compact('warehouses'));
    }
    public function showAddProductQuantity()
    {
        $products = Product::all();
        $warehouses = Warehouse::all();
        return view('Warehouse::showAddProductQuantity', compact('products', 'warehouses'));
    }

    public function showAddWarehouse()
    {
        $count = 1;
        $lastWarehouse = Warehouse::all()->last();
        if ($lastWarehouse) {
            $count = $lastWarehouse->id + 1;
        }

        return view('Warehouse::showAddWarehouse', compact('count'));

    }
    public function handleAddWarehouse(Request $request)
    {
        $checkWarehouse = Warehouse::where('code', $request->code)->first();
        $path = null;
        if ($checkWarehouse) {
            alert()->error('Oups!', 'Un entrepot de ce code existe déja  !');
            return redirect()->back();

        }

        $file = $request->photo;

        if ($file) {
            $path = $file->getClientOriginalName();

            $file->move('img', $file->getClientOriginalName());

        }

        Warehouse::create([
            'code' => $request->code,
            'designation' => $request->designation,
            'city' => $request->city,
            'postal_code' => $request->zipCode,
            'address' => $request->address,
            'complement' => $request->complement,
            'surface' => $request->surface,
            'complement_address' => $request->complement,
            'comment' => $request->comment,
            'photo' => $path,
        ]);
        alert()->success('Succés!', 'Entrepot a été ajouté avec succés !');
        return redirect()->route('showWarehouses');

    }

    public function showWarehouseDetail()
    {
        return view('Warehouse::showWarehouseDetail');

    }

    public function handleDeleteWarehouse($id)
    {
        $checkWarehouse=Warehouse::find($id);

        if($checkWarehouse)
        {
            $checkWarehouse->delete();
            alert()->success('Succés!', 'Entrepot a été supprimé avec succés !');
            return redirect()->back();
        }
        return view('General::notFound');

    }

    public function showUpdateWarehouse($id)
    {
        $checkWarehouse=Warehouse::find($id);

        if($checkWarehouse)
        {
           return view('Warehouse::showUpdateWarehouse',compact('warehouse'));
        }
        return view('General::notFound');

    }


    public function handleUpdateWarehouse($id)
    {
        $checkWarehouse=Warehouse::find($id);

        if($checkWarehouse)
        {
            $checkWarehouse->update($request->all());
            alert()->success('Succés!', 'Entrepot a été modifié avec succés !');
            return redirect()->back();
        }
        return view('General::notFound');

    }

}
