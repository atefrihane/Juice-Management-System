<?php

namespace App\Modules\Contact\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\SuperVisor\Models\SuperVisor;

class ContactController extends Controller
{

    public function showContacts($id)
    {
        $company = Company::find($id);
        $contacts[] =$company->director;
        $stores = $company->stores;

        foreach($stores as $store){
            if($store->super_visor_id != null){
                $supervisor = SuperVisor::find($store->super_visor_id);

                $contacts[] = $supervisor;
            }

            foreach ($store->responsables as $responsable){
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
        if ($company) {
            return view('User::AddClient', compact('company'));
        }
        return view('General::notFound');
    }

}
