<?php

namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Company\Models\CompanyHistory;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function showAddCompany()
    {
        $lastCompanyId = Company::all()->last()->id + 1;
        $countries = Country::all();

        return view('Company::addCompany', compact('lastCompanyId', 'countries'));
    }

    public function showCompany($id)
    {
        $company = Company::find($id);

        if ($company) {
            return view('Company::showCompany', compact('company'));
        }
        return view('General::notFound');

    }

    public function handleAddCompany(Request $request)
    {
        $val = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'zipcode_id' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:companies',
            'tel' => 'required',
            'cc' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'name.required' => 'le champs nom du group est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zipcode_id.required' => 'le champs code postale est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.unique' => 'Email deja existant',
            'email.email' => 'Email non valide',
            'cc.required' => 'le premier champs telephone est obligatoire',
            'tel.required' => 'le deuxieme champs telephone est obligatoire',
            'logo.image' => 'Le format du logo importé est non supporté ',
            'logo.mimes' => 'Le format du logo importé est non supporté ',
            'logo.max' => 'Logo importé est volumineux ! ',

        ]);

        if ($request->file('logo') != null) {
            $path = $request->file('logo')->store('img', 'public');

        } else {
            $path = 'img/company-placeholder.png';
        }
        $telephone = $request->cc . $request->tel;
        $insertable = $request->all();
        $insertable['tel'] = $telephone;
        $insertable['cc'] = null;
        $insertable['logo'] = 'files/' . $path;

        $company = Company::create($insertable);
        CompanyHistory::create([
            'changes' => 'creation',
            'company_id' => $company->id,
            'user_id' => Auth::id(),

        ]);
        alert()->success('Succés!', 'La societé a été ajoutée avec succés ')->persistent("Fermer");
        return redirect('/');

    }

    public function edit($id)
    {
        $company = Company::find($id);
        $countries = Country::all();
        $cities = City::all();
        $zipcodes=Zipcode::all();

        return view('Company::updateCompany', compact('company', 'countries', 'cities','zipcodes'));
    }

    public function update(Request $request, $id)
    {
        $val = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'zipcode_id' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'tel' => 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'name.required' => 'le champs nom du group est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zipcode_id.required' => 'le champs code postale est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.email' => 'email non valide',
            'tel.required' => 'le champs telephone est obligatoire',

        ]);
        $updateable = $request->all();
        unset($updateable['_token']);
        if ($request->file('logo') != null) {
            $path = $request->file('logo')->store('img', 'public');
            $updateable['logo'] = 'files/' . $path;
        } else {
            unset($updateable['logo']);
        }
        $company = Company::find($id);
        if ($company) {
            $changes = array();
            if ($company->code != $request->code) {
                array_push($changes, 'code');
            }
            if ($company->status != $request->status) {
                array_push($changes, 'status');
            }
            if ($company->name != $request->name) {
                array_push($changes, 'nom');
            }

            if ($company->country_id != $request->country_id) {
                array_push($changes, 'pays');
            }
            if ($company->designation != $request->designation) {
                array_push($changes, 'designation');
            }
            if ($company->city_id != $request->city_id) {
                array_push($changes, 'ville');
            }
            if ($company->zipcode_id != $request->zipcode_id) {
                array_push($changes, 'code postal');
            }
            if ($company->address != $request->address) {
                array_push($changes, 'addresse');
            }
            if ($company->complement != $request->complement) {
                array_push($changes, 'complement addresse');
            }
            if ($company->email != $request->email) {
                array_push($changes, 'email');
            }
            if ($company->tel != $request->tel) {
                array_push($changes, 'téléphone');
            }
            if ($company->comment != $request->comment) {
                array_push($changes, 'comment');
            }
            if ($request->logo && $company->logo != $request->logo) {
                array_push($changes, 'logo');
            }
            $changes = implode(",", $changes);

            $company->update($updateable);
            if ($changes!= "") {
                CompanyHistory::create([
                    'changes' => $changes,
                    'company_id' => $company->id,
                    'user_id' => Auth::id(),

                ]);

            }

            alert()->success('Succés!', 'La societé a été modifié avec succés ')->persistent("Fermer");
            return redirect()->route('showHome');

        }
        return view('General::notFound');

    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->delete();
            alert()->success('Succés!', 'La societé a été supprimé avec succés ')->persistent("Fermer");
            return redirect()->back();
        }
        alert()->error('Succés!', 'Societé introuvable !')->persistent("Fermer");
        return redirect()->back();
    }

}
