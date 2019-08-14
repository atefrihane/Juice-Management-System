<?php

namespace App\Modules\Company\Controllers\api;

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

    public function show($id)
    {
        $company = Company::where('id',$id)->with('stores')->first();
        return $company;

    }

    public function handleAddCompany(Request $request){
        $val = $request->validate([
            'code'=>'required',
            'name'=>'required',
            'designation'=>'required',
            'zip_code'=> 'required',
            'address'=>'required',
            'email'=> 'required|email|unique:companies',
            'tel'=> 'required',
            'cc'=> 'required',

        ], [
            'code.required' => 'le champs code est obligatoire',
            'name.required' => 'le champs nom du group est obligatoire',
            'designation.required' => 'le champs designation est obligatoire',
            'address.required' => 'le champs addresse est obligatoire',
            'zip_code.required' => 'le champs code postale est obligatoire',
            'email.required' => 'le champs email est obligatoire',
            'email.unique' => 'email deja existant',
            'email.email' => 'email non valide',
            'cc.required' => 'le premier champs telephone est obligatoire',
            'tel.required' => 'le deuxieme champs telephone est obligatoire',

        ]);
        $path = $request->file('logo')->store('img', 'public');
        $telephone = $request->cc.$request->tel;
        $insertable = $request->all();
        $insertable['tel'] = $telephone;
        $insertable['cc'] = null;
        $insertable['logo'] = 'files/'.$path;

        Company::create($insertable);
    return redirect('/');

    }

    public function edit($id){
        $company = Company::find($id);

        return view('Company::updateCompany', compact('company'));
    }

    public function update(Request $request, $id){
        $val = $request->validate([
            'code'=>'required',
            'name'=>'required',
            'designation'=>'required',
            'zip_code'=> 'required',
            'address'=>'required',
            'email'=> 'required|email',
            'tel'=> 'required',

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
        if($request->file('logo') != null){
            $path = $request->file('logo')->store('img', 'public');
            $updateable['logo'] = 'files/'.$path;
        }else {
            unset($updateable['logo']);
        }

        Company::query()->where('id',$id)->update($updateable);
        return redirect('/');
    }

    public function destroy($id){
        $company = Company::find($id);
        $company->delete();
        return redirect('/');
    }

}
