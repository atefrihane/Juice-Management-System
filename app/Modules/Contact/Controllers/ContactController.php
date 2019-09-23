<?php

namespace App\Modules\Contact\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\SuperVisor\Models\SuperVisor;
use App\Modules\User\Models\User;

class ContactController extends Controller
{

    public function showContacts($id)
    {
        $company = Company::find($id);

        $contacts[] = $company->director;

        $stores = $company->stores;

        foreach ($stores as $store) {
            if ($store->super_visor_id != null) {
                $supervisor = SuperVisor::find($store->super_visor_id);

                $contacts[] = $supervisor;
            }

            foreach ($store->responsables as $responsable) {
                $contacts[] = $responsable;
            }
        }
        $contacts = array_unique($contacts);

        if ($company) {
            return view('User::showClients', compact('company', 'contacts'));
        }
        return view('General::notFound');
    }

    public function showAddContact($id)
    {
        $company = Company::find($id);
        $count = User::count() + 1;

        if ($company) {

            return view('Contact::addClient', compact('company', 'count'));
        }
        return view('General::notFound');
    }

}
