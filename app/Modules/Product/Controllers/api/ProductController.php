<?php

namespace App\Modules\Product\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Mixture\Models\Mixture;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Store;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{

    public function handleUploadImage(Request $request)
    {

        $file = $request->photo;
        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'La photo doit être de  type: jpeg, png, jpg, svg']);
        }

        $path = $file->getClientOriginalName();

        $file->move('img', $file->getClientOriginalName());

        return response()->json(['status' => 200, 'path' => $path]);

    }

    public function store(Request $request)
    {

        $checkCode = Product::where('code', $request->code)->first();
        if ($checkCode) {
            return response()->json(['status' => 400]);
        }
        if ($request->photo) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/') . $name);
            $request->merge(['photo' => $name]);

        }

        $product = Product::create([
            'code' => $request->code,
            'status' => lcfirst($request->state),
            'type' => $request->type,
            'nom' => $request->name,
            'designation' => $request->designation,
            'barcode' => $request->barcode,
            'version' => $request->version,
            'composition' => $request->composition,
            'color' => $request->color,
            'weight' => $request->weight,
            'height' => $request->height,
            'width' => $request->width,
            'depth' => $request->depth,
            'public_price' => $request->publicPrice,
            'period_of_validity' => $request->validityClosed,
            'validity_after_opening' => $request->validityOpened,
            'comment' => $request->comment,
            'unit_by_display' => $request->unityPerDisplay,
            'unit_per_package' => $request->unityPerPack,
            'packing' => $request->packing,
            'tva' => $request->tva,
            'photo_url' => isset($name) ? $name : null,
        ]);

        if ($request->input('mixtures')) {
            foreach ($request->mixtures as $mixture) {

                Mixture::create([
                    'name' => $mixture['mixtureName'],
                    'type' => $mixture['type'],
                    'final_amount' => $mixture['endQuantityProduct'],
                    'needed_weight' => $mixture['necessaryWeight'],
                    'water_amount' => $mixture['waterQuantity'],
                    'sugar_amount' => $mixture['sugarQuantity'],
                    'glass_size' => $mixture['glassVolume'],
                    'number_of_glasses' => ($mixture['endQuantityProduct'] / ($mixture['glassVolume'] / 100)),
                    'product_id' => $product->id,
                ]);

            }

        }
        return response()->json(['status' => 200]);

    }

    public function index()
    {
        return Product::where('status','disponible')->get();
    }

    public function handleGetProductById($id)
    {

        $checkProduct = Product::find($id);

        if ($checkProduct) {

            return response()->json(['status' => 'status', 'product' => $checkProduct->mixtures]);

        } else {
            return response()->json(['status' => '404', 'product' => 'Product not found']);
        }

    }

    public function handleGetProductByName($name)
    {
        $checkProduct = Product::where('nom', $name)->first();
        if ($checkProduct) {
            return response()->json(['status' => '200', 'product' => $checkProduct]);

        } else {
            return response()->json(['status' => '404', 'product' => ' Product not found']);
        }

    }

    public function handleGetProductByBarcode($barcode)
    {

        $checkProduct = Product::where('barcode', $barcode)->first();
        if ($checkProduct) {
            return response()->json(['status' => '200', 'product' => $checkProduct]);

        } else {
            return response()->json(['status' => '404', 'product' => ' Product not found']);
        }

    }

    public function handleGetAllProduct()
    {
        $products = Product::where('status','disponible')->get();
        return response()->json(['status' => '200', 'products' => $products]);

    }

    public function handleUpdateProduct(Request $request, $id)
    {

        $product = Product::find($id);
        $checkCode = Product::where('code', $request->code)
            ->where('id', '!=', $product->id)
            ->first();
        if ($checkCode) {
            return response()->json(['status' => 400]);
        }
        $currentPhoto = $product->photo_url;
        if ($product) {

            if ($request->photo != $currentPhoto) {
                $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
                \Image::make($request->photo)->save(public_path('img/') . $name);
                $request->merge(['photo' => $name]);
                $userPhoto = public_path('img/') . $currentPhoto;
                if (file_exists($userPhoto)) {
                    @unlink($userPhoto);
                }
            }

            $product->update([
                'code' => $request->code,
                'status' => $request->state,
                'type' => $request->type,
                'nom' => $request->name,
                'designation' => $request->designation,
                'barcode' => $request->barcode,
                'version' => $request->version,
                'composition' => $request->composition,
                'color' => $request->color,
                'weight' => $request->weight,
                'height' => $request->height,
                'width' => $request->width,
                'depth' => $request->depth,
                'public_price' => $request->publicPrice,
                'period_of_validity' => $request->validityClosed,
                'validity_after_opening' => $request->validityOpened,
                'comment' => $request->comment,
                'unit_by_display' => $request->unityPerDisplay,
                'unit_per_package' => $request->unityPerPack,
                'packing' => $request->packing,
                'tva' => $request->tva,
                'photo_url' => isset($name) ? $name : $currentPhoto,
            ]);

            if ($request->input('mixtures') && $request->type != 'jettable') {
                foreach ($request->mixtures as $mixture) {
                    if (array_key_exists('id', $mixture)) {

                        $checkMixture = Mixture::find($mixture['id']);

                        $checkMixture->update([
                            'name' => $mixture['name'],
                            'type' => $mixture['type'],
                            'final_amount' => $mixture['final_amount'],
                            'needed_weight' => $mixture['needed_weight'],
                            'water_amount' => $mixture['water_amount'],
                            'sugar_amount' => $mixture['sugar_amount'],
                            'glass_size' => $mixture['glass_size'],
                            'number_of_glasses' => $mixture['final_amount'] / ($mixture['glass_size'] / 100),
                            'product_id' => $product->id,
                        ]);

                    } else {
                        Mixture::create([
                            'name' => $mixture['name'],
                            'final_amount' => $mixture['final_amount'],
                            'type' => $mixture['type'],
                            'needed_weight' => $mixture['needed_weight'],
                            'water_amount' => $mixture['water_amount'],
                            'sugar_amount' => $mixture['sugar_amount'],
                            'glass_size' => $mixture['glass_size'],
                            'number_of_glasses' => $mixture['final_amount'] / ($mixture['glass_size'] / 100),
                            'product_id' => $product->id,
                        ]);

                    }

                }

            } else {
                $product->mixtures()->delete();

            }

            return response()->json(['status' => 200]);

        }
    }
    public function handleGetProductDetails($id)
    {

        $product = Product::find($id);

        if ($product) {
            return response()->json(['status' => '200', 'product' => $product]);

        }
        return response()->json(['status' => '404']);

    }
    public function handleGetProductPrices($id, Request $request)
    {

        $product = Product::find($id);
        $checkCustomPrice = Store::find($request->store_id)->prices->where('product_id', $product->id)->first();

        if ($product) {
            return response()->json(['status' => '200', 'product' => $product, 'custom_price' => $checkCustomPrice]);

        }
        return response()->json(['status' => '404']);

    }

    public function handleGetProductInWarehouses(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $productInWarehouses = $product->warehouses()
                ->where('quantity', '>', 0)
                ->withPivot('id', 'packing', 'quantity', 'comment', 'creation_date', 'expiration_date')->get();

            return response()->json(['status' => 200, 'warehouse_products' => $productInWarehouses, 'productName' => $product->nom]);

        }
        return response()->json(['status' => 404]);

    }

}
