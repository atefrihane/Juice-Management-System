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
        $lastCompanyId = Company::count() + 1;
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
            'tel' => 'required',
            'cc' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'name.required' => 'le champs nom du group est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zipcode_id.required' => 'le champs code postale est obligatoire',
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
        $telephone = $request->cc . " " . $request->tel;
        $insertable = $request->all();
        $insertable['tel'] = $telephone;
        $insertable['cc'] = null;
        $insertable['logo'] = 'files/' . $path;
        $checkCode = Company::where('code', preg_replace('/\s/', '', $request->code))->first();
        if ($checkCode) {
            alert()->error('Oups', 'Code déja utilisé !')->persistent('Femer');
            return redirect()->back()->withInput();
        }

        $company = Company::create($insertable);
        CompanyHistory::create([
            'changes' => 'creation',
            'company_id' => $company->id,
            'user_id' => Auth::id(),

        ]);
        alert()->success('Succès!', 'La societé a été ajoutée avec succès ')->persistent("Fermer");
        return redirect('/');

    }

    public function edit($id)
    {
        $company = Company::find($id);

        if ($company) {
            $countries = Country::all();
            $cities = City::where('country_id', $company->country_id)->get();
            $zipcodes = Zipcode::where('city_id', $company->city_id)->get();

            return view('Company::updateCompany', compact('company', 'countries', 'cities', 'zipcodes'));

        }
        return view('General::notFound');

    }

    public function update(Request $request, $id)
    {
        $val = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'zipcode_id' => 'required',
            'address' => 'required',
            'tel' => 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'name.required' => 'le champs nom du group est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zipcode_id.required' => 'le champs code postale est obligatoire',
            'tel.required' => 'le champs telephone est obligatoire',

        ]);

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
            $fullTel = $request->cc . ' ' . $request->tel;

            if ($company->tel != $fullTel) {
                array_push($changes, 'téléphone');
            }
            if ($company->comment != $request->comment) {
                array_push($changes, 'comment');
            }
            if ($request->logo && $company->logo != $request->logo) {
                array_push($changes, 'logo');
            }
            $changes = implode(",", $changes);

            $checkCode = Company::where('code', preg_replace('/\s/', '', $request->code))
                ->where('id', '!=', $company->id)
                ->first();
            if ($checkCode) {
                alert()->error('Oups', 'Code déja utilisé !')->persistent('Femer');
                return redirect()->back();
            }
            $path = null;
            if ($request->logo) {
                $file = $request->logo;
                $path = '/img/' . $file->getClientOriginalName();

                $file->move('img', $file->getClientOriginalName());

            }

            $company->update([
                'code' => $request->code,
                'status' => $request->status,
                'name' => $request->name,
                'designation' => $request->designation,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'zipcode_id' => $request->zipcode_id,
                'address' => $request->address,
                'complement' => $request->complement,
                'email' => $request->email,
                'tel' => $fullTel,
                'comment' => $request->comment,
                'logo' => isset($path) ? $path : $company->logo,
            ]);
            if ($changes != "") {
                CompanyHistory::create([
                    'changes' => $changes,
                    'company_id' => $company->id,
                    'user_id' => Auth::id(),

                ]);

            }

            alert()->success('Succès!', 'La societé a été modifié avec succès ')->persistent("Fermer");
            return redirect()->route('showHome');

        }
        return view('General::notFound');

    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company) {
            if (!$company->stores()->exists() && (count($company->rentedMachines()) == 0)) {

                // check related stores and  their rentals ( set up rented machines as free)
                foreach ($company->stores as $store) {
                    $currentRentals = $store->rentals()->where('active', 1)->get();
                    if ($currentRentals) {
                        foreach ($currentRentals as $currentRental) {
                            $currentRental->machine->update(['rented' => 0]);
                        }

                    }

                }
                $company->delete();
                alert()->success('Succès!', 'La societé a été supprimé avec succès ')->persistent("Fermer");
                return redirect()->route('showHome');
            } else {
                alert()->error('Impossible de supprimer cette societé !', 'Oups! ')->persistent("Fermer");
                return redirect()->route('showHome');

            }

        }

        return view('General::notFound');
    }

}
