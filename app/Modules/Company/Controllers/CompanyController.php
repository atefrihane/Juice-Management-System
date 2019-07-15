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

    public function handleAddCompany(Request $request){
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
