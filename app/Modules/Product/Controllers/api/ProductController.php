<?php

namespace App\Modules\Product\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        // $prod =Product::create($request->all());
        return Product::create($request->all());
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
