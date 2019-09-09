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
            return $checkProduct;

        } else {
            return response()->json(['404']);
        }

    }

  

}
