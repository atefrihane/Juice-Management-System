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
                if ($city['name']) {
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

        }

        return response()->json(['status' => 200]);
    }

    public function handleUpdateCountryData($id, Request $request)
    {

        $country = Country::find($id);
        if ($country) {

            if ($country->name != $request->name) {
                $checkName = Country::where('name', $request->name)->first();
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
            $country->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            if ($request->deleted) {
                foreach ($request->deleted as $deleteId) {
                    City::find($deleteId)->delete();

                }
            }

            if ($request->cities) {

                foreach ($request->cities as $city) {

                    if (isset($city['cityName']) && isset($city['cityID'])) {
                        $checkCity = City::find($city['cityID']);

                        $checkCity->update([
                            'name' => $city['cityName'],
                            'country_id' => $country->id,
                        ]);

                        if (array_key_exists('zipCodes', $city)) {
                    
                            foreach ($checkCity->zipcodes as $zipcode) {
                                $zipcode->delete();

                            }
                            foreach ($city['zipCodes'] as $zipcode) {

                                Zipcode::create([
                                    'code' => $zipcode,
                                    'city_id' => $checkCity->id,
                                ]);

                            }
                        }

                    } else if (isset($city['cityName']) && !isset($city['cityID'])) {
                        $checkCity = City::where('name', $city['cityName'])->first();
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
                                    'code' => $zipcode,
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

}
