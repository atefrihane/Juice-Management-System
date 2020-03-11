<?php

namespace App\Modules\Store\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Modules\Store\Models\Store;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function show($id)
    {
        return new StoreResource(Store::find($id));
    }

    public function index()
    {
        return Store::all();
    }

    public function showStore($id)
    {
        $store = Store::with('country', 'city', 'zipcode')
            ->where('id', $id)
            ->first();
        if ($store) {
            return response()->json(['status' => 200, 'store' => $store, 'custom_prices' => $store->prices]);
        }
        return response()->json(['status' => 404]);
    }
    public function showStores()
    {
        return response()->json(['status' => 200, 'stores' => Store::all()]);

    }

    public function showFilteredStoresByUser($id, Request $request)
    {

        if (!$request->has('filteredData')) {
            return response()->json(['status' => 400]);

        }

        $checkUser = User::find($id);

        if ($checkUser) {
            switch ($checkUser->getType()) {
                case 'Directeur':return response()->json(['status' => 404, "User" => "wrong user"]);
                    break;
                case 'Autre':
                    if ($request->filled('filteredData')) {
                        if (!empty($request->input('filteredData') && is_array($request->input('filteredData')))) {

                            //validate numeric values

                            foreach ($request->input('filteredData') as $filterData) {
                                if (!(is_numeric($filterData))) {

                                    return response()->json(['status' => 404, "filteredData" => "wrong values"]);
                                }
                            }

                            //filter with selected stores
                            $activeRentals = Store::whereIn('id', $request->input('filteredData'))
                                ->with(['rentals' => function ($query) {
                                    return $query->where('active', 1)->with('machine.bacs');

                                }])
                                ->get();
                            return response()->json(['status' => 200, 'activeRentals' => $activeRentals]);

                        }

                        return response()->json(['status' => 404, "filteredData" => " filteredData values not filled"]);

                    } else {

                        $relatedStores = Store::whereHas('responsibles', function ($q) use ($checkUser) {
                            $q->where('responsible_id', $checkUser->child->id);
                        })
                            ->with('city.country', 'zipcode')
                            ->get();

                        if (!empty($relatedStores)) {
                            $activeRentals = Store::whereIn('id', $relatedStores->pluck('id'))
                                ->with(['rentals' => function ($query) {
                                    return $query->where('active', 1)->with('machine.bacs');

                                }])->get();

                        }

                        return response()->json(['status' => 200, 'activeRentals' => $activeRentals]);

                    }

                    break;

                default:
                    $activeRentals = Store::with(['rentals' => function ($query) {
                        return $query->where('active', 1)->with('machine.bacs');

                    }])->get();

                    return response()->json(['status' => 200, 'activeRentals' => $activeRentals]);

            }

        }

        return response()->json(['status' => 404, "User" => " user not found"]);
    }}
