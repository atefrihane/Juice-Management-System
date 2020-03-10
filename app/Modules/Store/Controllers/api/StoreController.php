<?php

namespace App\Modules\Store\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Modules\Store\Models\Store;
use App\Modules\User\Models\User;

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
            if ($request->filled('filteredData')) {
                //filter with selected stores
                $activeRentals = Store::whereIn('id', $request->input('filteredData'))
                    ->with(['rentals' => function ($query) {
                        return $query->where('active', 1)->with('machine.bacs');

                    }])
                    ->get();
                return response()->json(['status' => 200, 'relatedStores' => $relatedStores]);

            } else {

                $relatedStores = Store::whereHas('responsibles', function ($q) use ($user) {
                    $q->where('responsible_id', $user->child->id);
                })
                    ->with('city.country', 'zipcode')
                    ->get();

                if (!empty($relatedStores)) {
                    $activeRentals = Store::whereIn('id', $relatedStores->pluck('id'))
                        ->with(['rentals' => function ($query) {
                            return $query->where('active', 1)->with('machine.bacs');

                        }])->get();

                }

                return response()->json(['status' => 200, 'relatedStores' => $relatedStores]);

            }

        }
    }}
