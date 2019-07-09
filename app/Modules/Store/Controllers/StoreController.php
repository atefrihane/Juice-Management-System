<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;

class StoreController extends Controller
{
    public function showStores($id)
    {
        $company = Company::find($id);
        if ($company) {
            return view('Store::showStores', compact('company'));
        }
        return view('General::notFound');

    }

    public function showAddStore($id)
    {
        $company = Company::find($id);
        if ($company) {
            return view('Store::addStore', compact('company'));}
        return view('General::notFound');

    }

}
