<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Product\Models\Product;

class ProductController extends Controller
{

    public function showProducts()
    {
        $products = Product::all();

        return view('Product::showProducts', compact('products'));

    }

    public function showAddProduct()
    {

        return view('Product::addProduct');}

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

}
