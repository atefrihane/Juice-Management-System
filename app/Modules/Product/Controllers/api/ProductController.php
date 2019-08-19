<?php

namespace App\Modules\Product\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductResource;
use App\Modules\CompanyPrice\Models\CompanyPrice;

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

    public function handleAddProduct(Request $request)
    {


        $data = $request->input();
        $comp_id = null;
        $product_id = null;

        $company_price = new CompanyPrice;
        $company_price->price = $data["prix_societe"];
        $company_price->company_id = 1;
        $company_price->product_id = $data["id"];
        $company_price->save();


        return response()->json(['status' => 200, 'comp_id' => 1]);


        /*
CompanyPrice::create([
    'price'=>$data['price_societe'];
]);
        $company_price = new CompanyPrice;

        $company_price->price = $data["prix_societe"];
        $company_price->product_id = $data["id"];
        $company_price->company_id = 1;

        $company_price->save();
        */




    }

}
