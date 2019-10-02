<?php

namespace App\Modules\Product\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Mixture\Models\Mixture;
use App\Modules\Product\Models\Product;
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
            'photo_url' => $request->photo,
        ]);

        if ($request->input('mixtures')) {
            foreach ($request->mixtures as $mixture) {

                Mixture::create([
                    'name' => $mixture['mixtureName'],
                    'final_amount' => $mixture['endQuantityProduct'],
                    'needed_weight' => $mixture['necessaryWeight'],
                    'water_amount' => $mixture['waterQuantity'],
                    'sugar_amount' => $mixture['sugarQuantity'],
                    'glass_size' => $mixture['glassVolume'],
                    'number_of_glasses' => $mixture['glassNumber'],
                    'product_id' => $product->id,
                ]);

            }

        }
        return response()->json(['status' => 200]);

    }

    public function index()
    {
        return Product::all();
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
        $products = Product::all();
        return response()->json(['status' => '200', 'products' => $products]);

    }

    public function handleUpdateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {

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
                'photo_url' => $request->photo,
            ]);

            if ($request->input('mixtures') && $request->type != 'jettable') {
                foreach ($request->mixtures as $mixture) {
                    if (array_key_exists('id', $mixture)) {

                        $checkMixture = Mixture::find($mixture['id']);

                        $checkMixture->update($mixture);

                    } else {
                        Mixture::create([
                            'name' => $mixture['name'],
                            'final_amount' => $mixture['final_amount'],
                            'needed_weight' => $mixture['needed_weight'],
                            'water_amount' => $mixture['water_amount'],
                            'sugar_amount' => $mixture['sugar_amount'],
                            'glass_size' => $mixture['glass_size'],
                            'number_of_glasses' => $mixture['number_of_glasses'],
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

}
