<?php

namespace App\Modules\Product\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(Request $request){
        // $prod =Product::create($request->all());
        return Product::create($request->all());
    }

    public function index(){
        return Product::with('mixtures')->get();
    }

}
