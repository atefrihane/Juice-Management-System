<?php

namespace App\Modules\General\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;

class GeneralController extends Controller
{

    public function showHome()
    {

        $companies = Company::all();

        return view('General::home', compact('companies'));
    }

}
