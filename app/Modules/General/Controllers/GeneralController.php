<?php

namespace App\Modules\General\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\General\Models\Country;

class GeneralController extends Controller
{

    public function showHome()
    {

        $companies = Company::all();

        return view('General::home', compact('companies'))->withCookie(cookie('idtodelete', '', 120));
    }

    public function showStaticManagement()
    {
        return view('General::showStaticManagement', ['countries' => Country::all()]);

    }

    public function showAddCountry()
    {
        return view('General::showAddCountry');

    }

    public function handleDeleteCountry($id)
    {
        $country = Country::find($id);
        if ($country) {
            $country->delete();
            alert()->success('Le pays a été supprimé avec succés')->persistent('Fermer');
            return redirect()->back();
        }
        alert()->error('Pays introuvable')->persistent('Fermer');
        return redirect()->back();

    }

}
