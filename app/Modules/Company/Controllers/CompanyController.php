<?php

namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use Illuminate\Http\Request;

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

    public function handleAddCompany(Request $request)
    {
        $val = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'zip_code' => 'required',
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
            'zip_code.required' => 'le champs code postale est obligatoire',
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

        Company::create($insertable);
        return redirect('/');

    }

    public function edit($id)
    {
        $company = Company::find($id);

        return view('Company::updateCompany', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $val = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'tel' => 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'name.required' => 'le champs nom du group est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zip_code.required' => 'le champs code postale est obligatoire',
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

        Company::query()->where('id', $id)->update($updateable);
        return redirect('/');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect('/');
    }

}
