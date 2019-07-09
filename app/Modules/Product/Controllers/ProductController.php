<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;

class ProductController extends Controller
{

    public function showProducts()
    {

        return view('Product::showProducts');

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
