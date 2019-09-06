<?php

namespace App\Modules\CompanyPrice\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\CompanyPrice\Models\CompanyPrice;
use Illuminate\Http\Request;

class CompanyPriceController extends Controller
{

    public function handleStoreCustomPrice(Request $request, $id)
    {

        $checkCompany = CompanyPrice::where('product_id', $request->productId)
            ->where('company_id', $id)
            ->first();
        if ($checkCompany) {
            $checkCompany->update(['price' => $request->price]);

        } else {

            $CompanyPrice = CompanyPrice::create([
                'product_id' => $request->productId,
                'company_id' => $id,
                'price' => $request->price,
            ]);
            if ($CompanyPrice) {
                return response()->json(['status' => 200]);
            }

        }

        return response()->json(['status' => 400]);

    }
}
