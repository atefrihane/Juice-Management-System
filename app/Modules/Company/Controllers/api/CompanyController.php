<?php

namespace App\Modules\Company\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\User\Models\Director;
use App\Modules\User\Models\Responsible;
class CompanyController extends Controller
{

    public function show($id)
    {
        $company = Company::where('id', $id)->with('stores')->first();
        return $company;

    }
    public function index()
    {
        $companies = Company::all();
        return $companies;

    }
    public function showContacts($id)
    {
        $company = Company::find($id);
        if ($company) {
         

            if ($company->stores()->exists()) {

                $directors = Director::with('user')
                ->whereIn('id', $company->stores->pluck('director_id'))->get();
                $responsibles = Responsible::with('user')
                ->whereHas('stores', function ($q) use ($company) {
                    $q->whereIn('store_id', $company->stores->pluck('id'));
                })->get();

                $contacts = $directors->toBase()->merge($responsibles);
          
                return response()->json(['status' => 200, 'contacts' => $contacts]);

            }
            return response()->json(['status' => 400]);

        }
        return response()->json(['status' => 404]);
    }

}
