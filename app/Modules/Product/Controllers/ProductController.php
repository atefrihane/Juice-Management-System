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

        return view('Product::addProduct');
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
        $updateable = $request->all();
        if ($request->file('photo') != null) {
            $path = $request->file('logo')->store('img', 'public');
            $updateable['photo_url'] = 'files/' . $path;
        }
        unset($updateable['photo'], $updateable['_token']);
        Product::where('id', $id)->update($updateable);
        alert()->success('Succés!', 'Produit modifier');
        return redirect('/products');

    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        alert()->success('Succés!', 'Produit supprimé');
        return redirect('/products');
    }

    public function handleUpdateStatus($id, Request $request)
    {

        $product = Product::find($id);
        if ($product) {
            $product->update([
                'status' => $request->status == 'disponible' ? 'indisponible' : 'disponible',
            ]);
            alert()->success('Succés!', 'Etat produit modifié');
            return redirect()->back();
        }
        return view('General::notFound');

    }

}
