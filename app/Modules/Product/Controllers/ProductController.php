<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Price;
use App\Modules\Store\Models\Store;
use App\Modules\Store\Models\StorePrice;
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

        return view('Product::addProduct', compact('product'));
    }

    public function showCustomProducts($id)
    {

        $company = Company::find($id);
        $prices = Price::whereHas('stores.company', function ($query) use ($company) {
            $query->where('id', $company->id);
        })
            ->get();

        if ($company) {
            return view('Product::showCustomProducts', compact('company', 'prices'));
        }
        return view('General::notFound');

    }

    public function showAddCustomProduct($id)
    {
        $company = Company::find($id);
        $products = Product::all();

        if ($company) {
            return view('Product::addCustomProduct', compact('company', 'products'));
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

        $product = Product::find($id);

        $file = $request->photo_url;
        $path = $product->photo_url;

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

       
        alert()->success('Succès!', 'Produit modifié')->persistent("Fermer");
        return redirect('/products');

    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            if (!$product->prices()->exists() &&
                !$product->orders()->exists() &&
                !$product->bacs()->exists()
            ) {
                $product->delete();
                alert()->success('Succès!', 'Produit supprimé')->persistent("Fermer");
                return redirect('/products');

            } else {

                alert()->error('Cette entité ne peut pas être supprimée, autres entités y sont liées', 'Oups! ')->persistent("Fermer");
                return redirect()->back();
            }

        }
        return view('General::notFound');

    }

    public function handleUpdateStatus($id, Request $request)
    {

        $product = Product::find($id);
        if ($product) {
            $product->update([
                'status' => $request->status == 'disponible' ? 'non disponible' : 'disponible',
            ]);
            alert()->success('Succès!', 'Etat produit modifié')->persistent("Fermer");
            return redirect()->back();
        }
        return view('General::notFound');

    }

    public function showUpdateCustomProducts(Request $request, $id, $idPrice)
    {

        $price = Price::find($idPrice);

        $storedIds = $price->stores()->pluck('stores.id')->toArray();

        if ($price) {
            $company = Company::find($id);
            $freeStores = Store::whereNotIn('id', $storedIds)
                ->whereHas('company', function ($query) use ($company) {
                    $query->where('id', $company->id);
                })
                ->whereDoesntHave('prices', function ($query) use ($price) {
                    $query->where('product_id', $price->product_id);
                })
                ->get();
            $products = Product::all();
            $stores = Store::all();

            return view('Product::showUpdateCustomProduct', compact('company', 'price', 'products', 'stores', 'freeStores'));
        }
    }

    public function handleUpdateCustomProduct(Request $request, $id, $companyId)
    {
       

        $company = Company::find($companyId);
        $price = Price::find($id);
        $stores = Store::all();

        if ($price) {
            $storesIds = $stores->pluck('id')->toArray();
            if ($request->input('store_id')) {
                $detachedIds = array_diff($storesIds, $request->input('store_id'));
                $price->stores()->detach($detachedIds);

            } else {
                alert()->error('Veuillez séléctionner au moins un magasin','Oups!')->persistent('Fermer');
                return redirect()->back();
                // $price->stores()->detach();
            }
            $exist = false;
            //check if user has selected a different product and then make sure that the upcoming product not already exist
            if ($request->product_id != $price->product_id) {

                $checkPrice = Price::where('product_id', $request->product_id)
                    ->first();

                if ($checkPrice) {
                    $exist = true;

                } else {
                    $price->update(['product_id' => $request->product_id]);

                }

            }
            // if product always the same update the price
            else {
                $price->update(['price' => $request->price]);
            }

            if ($request->input('new_store_id')) {

                $price->stores()->attach($request->input('new_store_id'));

            }
            if ($exist) {
                alert()->error('Oups!', $checkPrice->product->nom . ' a déja un tarif !')->persistent("Fermer");
                return redirect()->back()->withInput();

            }

            alert()->success('Succès!', 'Tarif produit modifié !')->persistent("Fermer");

            return redirect()->route('showCustomProducts', $company->id)->with(['company' => $company, 'prices' => Price::all()]);

           

        }

    }
    public function handleDeleteCustomProduct(Request $request, $id)
    {

        $price = Price::find($id);

        if ($price) {
            if ($price->stores()->exists()) {
                alert()->error('Cette entité ne peut pas être supprimée, autres entités y sont liées', 'Oups! ')->persistent("Fermer");
                return redirect()->back();
            }
            $price->delete();
            alert()->success('Succès!', 'Produit est supprimé du tarif avec sucées')->persistent("Fermer");
            return redirect()->back();
        }

    }

    public function handleStoreCustomPrice(Request $request, $id)
    {

        if (!$request->input('store_id')) {
            alert()->error('Veuillez séléctionner au moins un magasin', 'Oups!')->persistent('Femer');
            return redirect()->back()->withInput();
        }
        $company = Company::find($id);
        if ($company) {

            if ($request->price < 0) {
                alert()->error('Oups!', 'Prix invalide!!')->persistent("Fermer");
                return redirect()->back();

            }

            $checkPrice = Price::where('product_id', $request->product_id)->first();

            //check if one of stores already has a tarif for a specific product
            if ($checkPrice) {

                foreach ($request->input('store_id') as $store_id) {
                    $checkStoreProduct = StorePrice::where('price_id', $checkPrice->id)
                        ->where('store_id', $store_id)
                        ->first();

                    if ($checkStoreProduct) {
                        alert()->error('Oups!', $checkStoreProduct->store->designation . ' a déja un tarif à ce produit')->persistent('Femer');
                        return redirect()->back();

                    }
                    if ($checkPrice->price == $request->price) {
                        $checkPrice->stores()->attach($store_id);

                        alert()->success('Succès!', 'Tarif ajouté !')->persistent("Fermer");
                        return redirect()->route('showCustomProducts', $company->id);

                    }

                    $price = Price::create(['price' => $request->price, 'product_id' => $request->product_id]);
                    $price->stores()->attach($store_id);
                    alert()->success('Succès!', 'Tarif ajouté !')->persistent("Fermer");
                    return redirect()->route('showCustomProducts', $company->id);

                }

            } else {

                $price = Price::create(['price' => $request->price, 'product_id' => $request->product_id]);
                $price->stores()->attach($request->input('store_id'));
                alert()->success('Succès!', 'Tarif ajouté !')->persistent("Fermer");
                return redirect()->route('showCustomProducts', $company->id);

            }

        }

        return view('General::notFound');

    }

    public function showProduct($id)
    {
        $product = Product::find($id);
        if ($product) {

            return view('Product::showProduct', compact('product'));

        }
        return view('General::notFound');
    }

}
