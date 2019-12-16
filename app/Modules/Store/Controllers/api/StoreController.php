<?php

namespace App\Modules\Store\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Modules\Store\Models\Store;

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

}
