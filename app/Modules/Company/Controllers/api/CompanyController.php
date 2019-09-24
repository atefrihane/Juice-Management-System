<?php

namespace App\Modules\Company\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;

class CompanyController extends Controller
{

    public function show($id)
    {
        $company = Company::where('id', $id)->with('stores')->first();
        return $company;

    }
    public function index()
    {
        $companies = Company::all();
        return $companies;

      

    }

}
