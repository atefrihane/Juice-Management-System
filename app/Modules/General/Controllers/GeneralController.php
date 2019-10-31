<?php

namespace App\Modules\General\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\General\Models\City;
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

    public function showUpdateCountry($id)
    {
        $country = Country::find($id);
        if ($country) {
            $cities = City::where('country_id', $country->id)->with('zipcodes', 'zipcodes.city')->get();

            return view('General::showUpdateCountry', compact('country', 'cities'));
        }
        return view('General::notFound');

    }

    public function handleDeleteCountry($id)
    {
        $country = Country::find($id);

        if ($country) {

            if ($country->companies->count() > 0) {
                alert()->error('Oups!', 'Le pays est déja affecté à ' . $country->companies->count() . ' societé(s) ! ')->persistent('Fermer');
                return redirect()->back();

            }
            if ($country->stores->count() > 0) {
                alert()->error('Oups!', 'Le pays est déja affecté à ' . $country->stores->count() . ' magasin(s) ! ')->persistent('Fermer');
                return redirect()->back();

            }

            if ($country->warehouses->count() > 0) {
                alert()->error('Oups!', 'Le pays est déja affecté à ' . $country->warehouses->count() . 'entrepôt(s) ! ')->persistent('Fermer');
                return redirect()->back();

            }
            $country->delete();
            alert()->success('Succès!', 'Le pays a été supprimé avec succès')->persistent('Fermer');
            return redirect()->back();
        }
        alert()->error('Pays introuvable')->persistent('Fermer');
        return redirect()->back();

    }

}
