<?php

namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;

class CompanyController extends Controller
{
    public function showAddCompany()
    {
        $lastCompanyId = Company::all()->last()->id + 1;

        return view('Company::addCompany', compact('lastCompanyId'));
    }

    public function showCompany($id)
    {
        $company = Company::find($id);

        if ($company) {
            return view('Company::showCompany', compact('company'));
        }
        return view('General::notFound');

    }

}
