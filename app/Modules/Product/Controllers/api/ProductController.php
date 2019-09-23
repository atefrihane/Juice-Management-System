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
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>400,'message'=>'La photo doit être de  type: jpeg, png, jpg, svg']);
        }
      
    
        $path = $file->getClientOriginalName();

        $file->move('img', $file->getClientOriginalName());

        return response()->json(['status' => 200, 'path' => $path]);

    }

    public function store(Request $request)
    {

        $product = Product::create([
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
        return Product::with('mixtures')->get();
    }

    public function handleGetProductById($id)
    {
        $checkProduct = Product::find($id);
        if ($checkProduct) {

            return response()->json(['status' => 'status', 'product' => $checkProduct]);

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

}
