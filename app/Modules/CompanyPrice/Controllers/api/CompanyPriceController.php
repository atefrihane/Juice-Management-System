<?php

namespace App\Modules\CompanyPrice\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\CompanyPrice\Models\CompanyPrice;
use Illuminate\Http\Request;

class CompanyPriceController extends Controller
{

    public function handleStoreCustomPrice(Request $request, $id)
    {
        dd($request->all());

        $checkCompany = CompanyPrice::where('product_id', $request->productId)
            ->where('company_id', $id)
            ->first();
        if ($checkCompany) {
            $validatedData = $request->validate([
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            ]);
            if ($validatedData) {

                $checkCompany->update(['price' => $request->price]);

            }
            return response()->json(['status' => 400]);

        } else {
            $validatedData = $request->validate([
                'price' => 'required|integer|min:0',
            ]);
            if ($validatedData) {
                $CompanyPrice = CompanyPrice::create([
                    'product_id' => $request->productId,
                    'company_id' => $id,
                    'price' => $request->price,
                ]);

                return response()->json(['status' => 200]);

            }
        }

        return response()->json(['status' => 400]);

    }
}
