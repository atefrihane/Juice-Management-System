<?php

namespace App\Modules\Warehouse\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductWarehouse;
use App\Modules\Warehouse\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    public function showWarehouseProducts()
    {
        $warehouseProducts = ProductWarehouse::all();
        return view('Warehouse::showWarehouseProducts', compact('warehouseProducts'));
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

    public function showWarehouseDetail($id)
    {
        return view('Warehouse::showWarehouseDetail');

    }

    public function handleDeleteWarehouse($id)
    {
        $checkWarehouse = Warehouse::find($id);

        if ($checkWarehouse) {
            $checkWarehouse->delete();
            alert()->success('Succés!', 'Entrepot a été supprimé avec succés !');
            return redirect()->back();
        }
        return view('General::notFound');

    }

    public function showUpdateWarehouse($id)
    {

        $checkWarehouse = Warehouse::find($id);

        if ($checkWarehouse) {
            return view('Warehouse::showUpdateWarehouse', compact('checkWarehouse'));
        }
        return view('General::notFound');

    }

    public function handleUpdateWarehouse($id, Request $request)
    {
        $checkWarehouse = Warehouse::find($id);

        if ($checkWarehouse) {
            $checkWarehouse->update($request->all());
            alert()->success('Succés!', 'Entrepot a été modifié avec succés !');
            return redirect()->route('showWarehouses');
        }
        return view('General::notFound');

    }

    public function handleAddProductQuantity(Request $request)
    {

        if ($request->product_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un produit ! !');
            return redirect()->back();
        }
        if ($request->warehouse_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un entrepôt ! !');
            return redirect()->back();

        }
        ProductWarehouse::create($request->all());
        alert()->success('Succés!', 'Le produit a été ajouté avec succés ! !');
        return redirect()->route('showWarehouseProducts');

    }

    public function showEditProductQuantity($id)
    {
        $productQuantity = ProductWarehouse::find($id);
        if ($productQuantity) {
            $products = Product::all();
            $warehouses = Warehouse::all();
            return view('Warehouse::showEditProductQuantity', compact('productQuantity', 'products', 'warehouses'));

        }
        return view('General::notFound');

    }

    public function handleEditProductQuantity($id, Request $request)
    {

        if ($request->product_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un produit ! !');
            return redirect()->back();
        }
        if ($request->warehouse_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un entrepôt ! !');
            return redirect()->back();

        }
        $productWarehouse = ProductWarehouse::find($id);
        if ($productWarehouse) {
            $productWarehouse->update($request->all());
            alert()->success('Succés!', 'Le produit a été modifié avec succés ! !');
            return redirect()->route('showWarehouseProducts');
        }

        return view('General::notFound');

    }

    public function handleDeleteProductQuantity($id)
    {

        $productWarehouse = ProductWarehouse::find($id);
        if ($productWarehouse) {

            $productWarehouse->delete();

            alert()->success('Succés!', 'Le produit a été supprimé avec succés !');
            return redirect()->back();
        }
        return view('General::notFound');
    }

}
