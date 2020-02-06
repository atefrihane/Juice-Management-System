<?php

namespace App\Modules\General\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function handleAddCountryData(Request $request)
    {
       
        $val = $request->validate([
            'name' => 'required|min:0|max:150',
            'code' => 'required|regex:/^\+\d{1,5}$/',
       
        ], [
            'name.required' => 'Nom pays n\'est pas valide',
            'name.min' => '  Nom pays n\'est pas valide',
            'name.max' => '  Nom pays n\'est pas valide',
            'code.regex' => ' Code pays  n\'est pas valide',
            'code.required' => ' Code pays  est obligatoire',
            'code.regex' => ' Code pays  n\'est pas valide',
      
        ]);
        $checkName = Country::where('name',  $request->name)->first();
        $checkCode = Country::where('code',  $request->code)->first();
        if ($checkName) {
            return response()->json(['status' => 401]);
        }

        if ($checkCode) {
            return response()->json(['status' => 402]);
        }

        $country = Country::create([
            'name' =>   $request->name,
            'code' =>   $request->code
        ]);

        if ($request->cities) {
            foreach ($request->cities as $city) {
                if ($city['name']) {
                    $newCity = City::create([
                        'name' =>  $city['name'],
                        'country_id' => $country->id,
                    ]);

                    if (array_key_exists('zipcodes', $city)) {

                        foreach ($city['zipcodes'] as $zipcode) {
                            Zipcode::create([
                                'code' =>  $zipcode,
                                'city_id' => $newCity->id,
                            ]);

                        }
                    }
                }

            }

        }

        return response()->json(['status' => 200]);
    }

    public function handleUpdateCountryData($id, Request $request)
    {
        $val = $request->validate([
            'name' => 'required|min:0|max:150',
            'code' => 'required|regex:/^\+\d{1,5}$/',
       
        ], [
            'name.required' => 'Nom pays n\'est pas valide',
            'name.min' => '  Nom pays n\'est pas valide',
            'name.max' => '  Nom pays n\'est pas valide',
            'code.regex' => ' Code pays  n\'est pas valide',
            'code.required' => ' Code pays  est obligatoire',
            'code.regex' => ' Code pays  n\'est pas valide',
      
        ]);


        $country = Country::find($id);
        if ($country) {

            if ($country->name != $request->name) {
                $checkName = Country::where('name', $request->name)
                    ->first();
                if ($checkName) {

                    return response()->json(['status' => 401]);

                }

            }

            if ($country->name == $request->name) {
                $checkName = Country::where('name', $request->name)
                    ->where('id', '!=', $country->id)
                    ->first();
                if ($checkName) {

                    return response()->json(['status' => 401]);

                }

            }

            if ($country->code != $request->code) {
                $checkCode = Country::where('code', $request->code)->first();
                if ($checkCode) {

                    return response()->json(['status' => 402]);

                }

            }

            if ($country->code == $request->code) {
                $checkName = Country::where('code', $request->name)
                    ->where('id', '!=', $country->id)
                    ->first();
                if ($checkName) {

                    return response()->json(['status' => 402]);

                }

            }
         
            $country->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);
   

            if ($request->cities) {

                foreach ($request->cities as $city) {

                    if (isset($city['cityName']) && isset($city['cityID'])) {
                        $checkCity = City::find($city['cityID']);

                        $checkCity->update([
                            'name' =>  $city['cityName'],
                            'country_id' => $country->id,
                        ]);

                        if (array_key_exists('zipCodes', $city)) {

                            foreach ($city['zipCodes'] as $zipcode) {
                                if ($zipcode['id']) {
                                    ZipCode::find($zipcode['id'])->update(['code' => $zipcode['code']]);
                                } else {
                                    ZipCode::create([
                                        'code' => $zipcode['code'],
                                        'city_id' => $city['cityID'],
                                    ]);
                                }
                            }
                        }

                    } else if (isset($city['cityName']) && !isset($city['cityID'])) {
                  
                        $checkCity = City::where('name', $city['cityName'])
                        ->where('country_id',$country->id)
                        ->first();
                        if ($checkCity) {
                            return response()->json(['status' => 403]);

                        }
                     

                        $newCity = City::create([
                            'name' => $city['cityName'],
                            'country_id' => $country->id,
                        ]);
                     

                        if (array_key_exists('zipCodes', $city)) {
                       
                            foreach ($city['zipCodes'] as $zipcode) {
                      

                                Zipcode::create([
                                    'code' =>  $zipcode['code'],
                                    'city_id' => $newCity->id,
                                ]);

                            }
                 
                        }

                    }

                }
            }
            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404]);

    }

    public function handleGetCountryCities($id)
    {

        $country = Country::find($id);

        if ($country) {

            return response()->json(['status' => 200, 'code' => $country->code, 'cities' => $country->cities]);

        }
        return response()->json(['status' => 404]);

    }

    public function handleGetCityZipcodes($id)
    {
        $city = City::find($id);

        if ($city) {

            return response()->json(['status' => 200, 'zipcodes' => $city->zipcodes]);

        }

    }
    public function handleGetCityCompanies($id)
    {

        $city = City::find($id);

        if ($city) {

            return response()->json(['status' => 200, 'countCompanies' => $city->companies->count(),'countStores' => $city->stores->count(),'countWarehouses' =>$city->warehouses->count()]);

        }
        return response()->json(['status' => 404]);

    }
    public function handleDeleteCity($id)
    {
        $city = City::find($id);
        if ($city) {
            $city->delete();
            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404]);
    }

    public function handleGetZipcodes($id)
    {
        $zipcode = Zipcode::find($id);
        if ($zipcode) {

            return response()->json([
                'status' => 200,
                'countCompanies' => $zipcode->companies->count(),
                'countStores' => $zipcode->stores->count(),
                'countWarehouses' => $zipcode->warehouses->count()
                
                ]);
          

        }
        return response()->json(['status' => 404]);
    }

    public function handleDeleteZipCode($id)
    {

        $zipcode = Zipcode::find($id);

        if ($zipcode) {
            $zipcode->delete();
            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404]);

    }

    public function handleUpdateZipCode($id, Request $request)
    {
        $zipcode = Zipcode::find($id);

        if ($zipcode) {
            $zipcode->update(['code' => $request->code]);

            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);

    }

}
