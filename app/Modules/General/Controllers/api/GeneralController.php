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

        $checkName = Country::where('name', $request->name)->first();
        $checkCode = Country::where('code', $request->code)->first();
        if ($checkName) {
            return response()->json(['status' => 401]);
        }

        if ($checkCode) {
            return response()->json(['status' => 402]);
        }

        $country = Country::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        if ($request->cities) {
            foreach ($request->cities as $city) {
                $newCity = City::create([
                    'name' => $city['name'],
                    'country_id' => $country->id,
                ]);

                if (array_key_exists('zipcodes', $city)) {

                    foreach ($city['zipcodes'] as $zipcode) {
                        Zipcode::create([
                            'code' => $zipcode,
                            'city_id' => $newCity->id,
                        ]);

                    }
                }

            }

        }

        return response()->json(['status' => 200]);
    }

}
