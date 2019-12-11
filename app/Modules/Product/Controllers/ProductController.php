<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Mixture\Models\Mixture;
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

        foreach ($request->mixtures as $mixture) {

            $mixture = Mixture::find($mixture[0])
                ->update([
                    'name' => $mixture[1],
                    'final_amount' => $mixture[2],
                    'needed_weight' => $mixture[3],
                    'water_amount' => $mixture[4],
                    'sugar_amount' => $mixture[5],
                    'glass_size' => $mixture[6],
                    'number_of_glasses' => $mixture[7],
                ]);

        }

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
            if ($request->input('store_id')) {
                foreach ($stores as $store) {
                    if (!in_array($store->id, $request->input('store_id'))) {
                        $price->stores()->detach($store->id);

                    }

                }

            } else {
                $price->stores()->detach();
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
                foreach ($request->input('new_store_id') as $new_store_id) {
                    $price->stores()->attach($new_store_id);

                }
            }
            if ($exist) {
                alert()->error('Oups!', $checkPrice->product->nom . ' a déja un tarif !')->persistent("Fermer");
                return redirect()->back()->withInput();

            }

            alert()->success('Succès!', 'Tarif produit modifié !')->persistent("Fermer");

            return redirect()->route('showCustomProducts', $company->id)->with(['company' => $company, 'prices' => Price::all()]);

            // else {
            //     $price->stores()->detach();
            // }

            //check if old store exists in upcoming array otherwise delete it

            //check if the upcoming store already exists otherwise add it
            // if ($request->input('new_store_id')) {
            //     foreach ($request->input('store_id') as $store_id) {
            //         $checkStorePrice = StorePrice::where('price_id', $price->id)
            //             ->where('store_id', $store_id)
            //             ->first();
            //         if (!$checkStorePrice) {

            //             $price->stores()->attach($store_id);

            //         } else {

            //             alert()->error('Oups!', $checkStorePrice->store->designation . ' a déja un tarif à ce produit')->persistent('Femer');
            //             return redirect()->back();

            //         }

            //     }

            // }

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
            alert()->error('Oups!', 'Veuillez séléctionner au moins un magasin !')->persistent('Femer');
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
