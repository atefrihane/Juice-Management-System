<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Store\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function showStores($id)
    {$company = Company::find($id);
        $stores = Store::query()->whereCompanyId($id)->get();
        if ($company) {
            return view('Store::showStores', compact('company', 'stores'));
        }
        return view('General::notFound');

    }

    public function showAddStore($company_id)
    {
        $company = Company::find($company_id);
        $lastStoreId = Company::all()->last()->id + 1;
        if ($company) {
            return view('Store::addStore', compact('company', 'lastStoreId'));}
        return view('General::notFound');

    }

    public function store($company_id, Request $request)
    {
        $val = $request->validate([
            'code' => 'required',
            'sign' => 'required',
            'designation' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:companies',
            'tel' => 'required',
            'cc' => 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'sign.required' => 'le champs enseigne  est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zip_code.required' => 'le champs code postale est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.unique' => 'email deja existant',
            'email.email' => 'email non valide',
            'cc.required' => 'le premier champs telephone est obligatoire',
            'tel.required' => 'le deuxieme champs telephone est obligatoire',

        ]);

        if ($request->file('photo') != null) {
            $path = $request->file('photo')->store('img', 'public');
        } else {
            $path = 'img/company-placeholder.png';
        }

        $telephone = $request->cc . " " . $request->tel;
        $insertable = $request->all();
        $insertable['tel'] = $telephone;
        unset($insertable['cc']);
        $insertable['photo'] = 'files/' . $path;
        $insertable['company_id'] = $company_id;

        Store::create($insertable);
        return redirect(route('showStores', $company_id));

    }

    public function edit($id)
    {
        $store = Store::find($id);
        $company = Company::find($store->company_id);
        return view("Store::editStore", compact('store', 'company'));
    }

    public function update($id, Request $request)
    {
        $val = $request->validate([
            'code' => 'required',
            'sign' => 'required',
            'designation' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'cc' => 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'sign.required' => 'le champs enseigne  est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zip_code.required' => 'le champs code postale est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.email' => 'email non valide',
            'cc.required' => 'le premier champs telephone est obligatoire',
            'tel.required' => 'le deuxieme champs telephone est obligatoire',

        ]);
        $updateable = $request->all();
        $store = Store::find($id);
        unset($updateable['_token']);
        $updateable['tel'] = $request->cc . ' ' . $request->tel;
        unset($updateable['cc']);
        if ($request->file('photo') != null) {
            $path = $request->file('photo')->store('img', 'public');
            $updateable['photo'] = 'files/' . $path;
        } else {
            unset($updateable['logo']);
        }

        Store::query()->where('id', $id)->update($updateable);
        return redirect(route('showStores', $store->company_id));
    }

    public function delete($id)
    {
        $store = Store::find($id);
        $companyId = $store->company_id;
        $store->delete();
        alert()->success('Succés!', 'Le magasin  a été supprimé avec succés ')->persistent("Fermer");
        return redirect(route('showStores', $companyId));
    }

    public function showStore($id, $idStore)
    {
        $store = Store::find($idStore);

        if ($store) {
            return view('Store::showStore', compact('store'));
        }
        return view('General::notFound');

    }

    public function showStoreRentals($id, $idStore)
    {$store = Store::find($idStore);
        if ($store) {
            $rentals = MachineRental::where('store_id', $idStore)
            ->where('active',1)
            ->get();
            return view('Store::showStoreMachines', compact('rentals', 'store'));
        }
        return view('General::notFound');

    }

}
