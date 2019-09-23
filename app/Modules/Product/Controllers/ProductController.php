<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function showProducts()
    {
        $products = Product::all();

        return view('Product::showProducts', compact('products'));

    }

    public function showAddProduct()
    {
        $product = 0;
        $count = Product::count();

        if ($count > 0) {
            $product = Product::all()->last()->id + 1;

        } else {
            $product = 1;
        }
  

        return view('Product::addProduct',compact('product'));
    }

    public function showCustomProducts($id)
    {
        $company = Company::find($id);

        if ($company) {
            return view('Product::showCustomProducts', compact('company'));
        }
        return view('General::notFound');

    }

    public function showAddCustomProduct($id)
    {
        $company = Company::find($id);

        if ($company) {
            return view('Product::addCustomProduct', compact('company'));
        }
        return view('General::notFound');

    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view("Product::update", compact('product'));
    }

    public function update(Request $request, $id)
    {

        $product=Product::find($id);

        $file = $request->photo_url;
        $path =$product->photo_url;

        $validate = $request->validate([
            'photo_url' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'photo_url.image' => 'Le format de la photo importé est non supporté ',
            'photo_url.mimes' => 'Le format de la photo importé est non supporté ',
            'photo_url.max' => 'La photo importé est volumineuse ! ',

        ]);

        if ($file) {
            $path = $file->getClientOriginalName();

            $file->move('img', $file->getClientOriginalName());

        }

      $product->update([
            'status' => $request->status,
            'nom' => $request->nom,
            'type' => $request->type,
            'version' => $request->version,
            'barcode' => $request->barcode,
            'composition' => $request->composition,
            'color' => $request->color,
            'width' => $request->width,
            'height' => $request->height,
            'depth' => $request->depth,
            'public_price' => $request->public_price,
            'period_of_validity' => $request->period_of_validity,
            'validity_after_opening' => $request->validity_after_opening,
            'comment' => $request->comment,
            'unit_by_display' => $request->unit_by_display,
            'unit_per_package' => $request->unit_per_package,
            'packing' => $request->packing,
            'photo_url' => $path,

        ]);
        alert()->success('Succés!', 'Produit modifié')->persistent("Fermer");
        return redirect('/products');

    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        alert()->success('Succés!', 'Produit supprimé')->persistent("Fermer");
        return redirect('/products');
    }

    public function handleUpdateStatus($id, Request $request)
    {

        $product = Product::find($id);
        if ($product) {
            $product->update([
                'status' => $request->status == 'disponible' ? 'non disponible' : 'disponible',
            ]);
            alert()->success('Succés!', 'Etat produit modifié')->persistent("Fermer");
            return redirect()->back();
        }
        return view('General::notFound');

    }

}
