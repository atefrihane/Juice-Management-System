<?php

namespace App\Modules\Warehouse\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductWarehouse;
use App\Modules\User\Models\User;
use App\Modules\Warehouse\Models\Warehouse;
use App\Repositories\Image;
use App\Repositories\Validation;
use File;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{



    protected $validation,$image;

    public function __construct(Image $image, Validation $validation)
    {

        $this->validation = $validation;
        $this->image = $image;
    }

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

        $countries = Country::all();
        $users = User::all();
        $count = Warehouse::count() + 1;

        return view('Warehouse::showAddWarehouse', compact('count', 'countries', 'users'));

    }
    public function handleAddWarehouse(Request $request)
    {

        $val = $request->validate([
            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
             'designation' => 'required',
            'zipcode_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'surface' => 'required|min:1|max:999999',
            'address' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',

        ], [
            'code.required' => ' Code est obligatoire',
            'code.regex' => ' Code n\'est pas valide',
            'code.alpha_dash' => ' Code n\'est pas valide',
            'designation.required' => ' designation  est requis',
            'zipcode_id.required' => ' code postale est requis',
            'country_id.required' => ' pays est requis',
            'city_id.required' => ' Ville est requis',
            'surface.required' => ' Surface est requis',
            'surface.min' => ' Surface n\'est pas valide',
            'surface.max' => ' Surface n\'est pas valide',
            'photo.image' => 'Le format du photo importé est non supporté ',
            'photo.mimes' => 'Le format du photo importé est non supporté ',
            'photo.max' => 'Photo importé est volumineuse ! ',
        ]);


        $checkWarehouse = Warehouse::where('code', $request->code)->first();
        $path = null;
        if ($checkWarehouse) {
            alert()->error('Oups!', 'Un entrepôt de ce code existe déja  !')->persistent('Femer');
            return redirect()->back()->withInput();

        }

        $file = $request->photo;

        if ($file) {
            $path = $this->image->uploadBinaryImage($file);

        }

        Warehouse::create([
            'code' => $request->code,
            'designation' => $request->designation,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'zipcode_id' => $request->zipcode_id,
            'user_id' => $request->user_id,
            'address' => $request->address,
            'complement' => $request->complement,
            'surface' => $request->surface,
            'complement_address' => $request->complement,
            'comment' => $request->comment,
            'photo' => $path ? $path : null,
        ]);
        alert()->success('Entrepôt a été ajouté avec succés !', 'Succés!')->persistent('Femer');
        return redirect()->route('showWarehouses');

    }

    public function showWarehouse($id)
    {
        $warehouse = Warehouse::find($id);

        if ($warehouse) {
            return view('Warehouse::showWarehouse', compact('warehouse'));

        }
        return view('General::notFound');

    }

    public function showAddWarehouseStock($id)
    {
        $warehouse = Warehouse::find($id);
        $products = Product::all();
        $warehouses = Warehouse::all();
        if ($warehouse) {

            return view('Warehouse::showAddWarehouseStock', compact('warehouse', 'products', 'warehouses'));

        }
        return view('General::notFound');

    }

    public function handleDeleteWarehouse($id)
    {

        $checkWarehouse = Warehouse::find($id);

        if ($checkWarehouse) {
            if (!$checkWarehouse->products()->exists()) {
                $checkWarehouse->delete();
                alert()->success('Entrepôt a été supprimé avec succés !', 'Succés!')->persistent('Femer');
                return redirect()->route('showWarehouses');

            } else {
                alert()->error('Cette entité ne peut pas être supprimée, autres entités y sont liées', 'Oups! ')->persistent("Fermer");
                return redirect()->back();
            }

        }
        return view('General::notFound');

    }

    public function showUpdateWarehouse($id)
    {

        $checkWarehouse = Warehouse::find($id);

        if ($checkWarehouse) {
            $users = User::all();
            $countries = Country::all();
            $cities = City::where('country_id', $checkWarehouse->country_id)->get();
            $zipcodes = Zipcode::where('city_id', $checkWarehouse->city_id)->get();
            return view('Warehouse::showUpdateWarehouse', compact('checkWarehouse', 'countries', 'cities', 'zipcodes', 'users'));
        }
        return view('General::notFound');

    }

    public function handleUpdateWarehouse($id, Request $request)
    {
        $val = $request->validate([
            'code' => 'required|regex:/^[A-Z0-9]+$/|alpha_dash',
             'designation' => 'required',
            'zipcode_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'surface' => 'required|min:1|max:999999',
            'address' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',

        ], [
            'code.required' => ' Code est obligatoire',
            'code.regex' => ' Code n\'est pas valide',
            'code.alpha_dash' => ' Code n\'est pas valide',
            'designation.required' => ' designation  est requis',
            'zipcode_id.required' => ' code postale est requis',
            'country_id.required' => ' pays est requis',
            'city_id.required' => ' Ville est requis',
            'surface.required' => ' Surface est requis',
            'surface.min' => ' Surface n\'est pas valide',
            'surface.max' => ' Surface n\'est pas valide',
            'photo.image' => 'Le format du photo importé est non supporté ',
            'photo.mimes' => 'Le format du photo importé est non supporté ',
            'photo.max' => 'Photo importé est volumineuse ! ',
        ]);


        $checkWarehouse = Warehouse::find($id);
        $path = null;
        if ($checkWarehouse) {

            $checkWarehouseCode = Warehouse::where('code', $request->code)
                ->where('id', '<>', $checkWarehouse->id)
                ->first();
            if ($checkWarehouseCode) {
                alert()->error('Oups!', 'Un entrepôt de ce code existe déja  !')->persistent('Femer');
                return redirect()->back();

            }
            $file = $request->photo;

        if ($file) {
            $path = $this->image->uploadBinaryImage($file);

        }

            $checkWarehouse->update([
                'code' => $request->code,
                'designation' => $request->designation,
                'city_id' => $request->city_id,
                'country_id' => $request->country_id,
                'zipcode_id' => $request->zipcode_id,
                'user_id' => $request->user_id,
                'address' => $request->address,
                'complement_address' => $request->complement_address,
                'surface' => $request->surface,
                'comment' => $request->comment,
                'photo' => $path ? $path : $checkWarehouse->photo,
            ]);
            alert()->success('Succés!', 'Entrepôt a été modifié avec succés !')->persistent('Femer');
            return redirect()->route('showWarehouses');
        }
        return view('General::notFound');

    }

    public function handleAddProductQuantity(Request $request)
    {

        $request->validate([
            'stock_display' => 'required|digits_between:1,6',
            'packing_display' => 'required|digits_between:1,6',
            'packing' => 'required|digits_between:1,6',
            'quantity' => 'required|digits_between:1,6||min:0|not_in:0',
            'creation_date' => 'required|date',
            'expiration_date' => 'required|date',

        ], [
            'stock_display.required' => ' Nombre d\'unités par display est requis',
            'stock_display.digits_between' => ' Nombre d\'unités par display n\'est pas valide',
            'packing_display.required' => ' Nombre de display par colis est requis',
            'packing_display.digits_between' => ' Nombre de display par colis n\'est pas valide',
            'packing.required' => ' Colisage est requis',
            'packing.digits_between' => ' Colisage n\'est pas valide',
            'creation_date.required' => ' Date de fabrication est requis',
            'expiration_date.required' => 'le  champs Date de péremption est requis',
            'quantity.required' => 'le  champs quantité est requis',
            'quantity.min' => ' Quantité n\est pas valide',
            'quantity.not_in' => ' Quantité n\est pas valide',
            'quantity.digits_between' => ' Quantité n\'est pas valide',

        ]);

        if ($request->product_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un produit ! !')->persistent('Femer');
            return redirect()->back()->withInput();
        }
        if ($request->warehouse_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un entrepôt ! !')->persistent('Femer');
            return redirect()->back()->withInput();

        }
        if ($request->expiration_date < $request->creation_date) {
            alert()->error('Oups!', 'Veuillez vérifier les dates !')->persistent('Femer');
            return redirect()->back()->withInput();

        }

        ProductWarehouse::create($request->except(
            '_token',
            'url',
            'productCode',
            'productBarcode',
            'productPacking',
            'defaultDisplay',
            'defaultPacking',
            'productPacking'

        ));
        alert()->success('Succés!', 'Le produit a été ajouté avec succés')->persistent('Femer');
        return redirect($request->url);

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

        $request->validate([
            'stock_display' => 'required|digits_between:1,6',
            'packing_display' => 'required|digits_between:1,6',
            'packing' => 'required|digits_between:1,6',
            'quantity' => 'required|digits_between:1,6||min:0|not_in:0',
            'creation_date' => 'required|date',
            'expiration_date' => 'required|date',

        ], [
            'stock_display.required' => ' Nombre d\'unités par display est requis',
            'stock_display.digits_between' => ' Nombre d\'unités par display n\'est pas valide',
            'packing_display.required' => ' Nombre de display par colis est requis',
            'packing_display.digits_between' => ' Nombre de display par colis n\'est pas valide',
            'packing.required' => ' Colisage est requis',
            'packing.digits_between' => ' Colisage n\'est pas valide',
            'creation_date.required' => ' Date de fabrication est requis',
            'expiration_date.required' => 'le  champs Date de péremption est requis',
            'quantity.required' => 'le  champs quantité est requis',
            'quantity.min' => ' Quantité n\est pas valide',
            'quantity.not_in' => ' Quantité n\est pas valide',
            'quantity.digits_between' => ' Quantité n\'est pas valide',

        ]);

        if ($request->product_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un produit ! ')->persistent('Femer');
            return redirect()->back()->withInput();
        }
        if ($request->warehouse_id == 0) {
            alert()->error('Oups!', 'Veuillez selectionner un entrepôt ! ')->persistent('Femer');
            return redirect()->back()->withInput();

        }

        if ($request->expiration_date < $request->creation_date) {
            alert()->error('Oups!', 'Veuillez vérifier les dates !')->persistent('Femer');
            return redirect()->back()->withInput();

        }
        $productWarehouse = ProductWarehouse::find($id);
        if ($productWarehouse) {
            $productWarehouse->update($request->all());
            alert()->success('Succés!', 'Le produit a été modifié avec succés ! !')->persistent('Femer');
            return redirect()->route('showWarehouseProducts');
        }

        return view('General::notFound');

    }

    public function handleDeleteProductQuantity($id)
    {
        $productWarehouse = ProductWarehouse::where('product_id', $id)->first();

        if ($productWarehouse) {

            $productWarehouse->delete();

            alert()->success('Succés!', 'Le produit a été supprimé avec succés')->persistent('Femer');
            return redirect()->back();
        }
        return view('General::notFound');
    }

    public function handleDeleteWarehouseQuantity($id)
    {
        $productWarehouse = ProductWarehouse::find($id);

        if ($productWarehouse) {

            $productWarehouse->delete();

            alert()->success('Succés!', 'Le produit a été supprimé avec succés')->persistent('Femer');
            return redirect()->back();
        }
        return view('General::notFound');
    }

}
