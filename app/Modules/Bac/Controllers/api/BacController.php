<?php

namespace App\Modules\Bac\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\BacHistory\Models\BacHistory;
use App\Modules\Bac\Models\Bac;
use App\Modules\Product\Models\Product;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;

class BacController extends Controller
{

    public function storeAll(Request $request)
    {
        $bacs = $request->all();
        $rbacs = [];
        foreach ($bacs as $bac) {
            unset($bac['product']);
            $rbacs[] = Bac::create($bac);

        }
        return $rbacs;
    }

    public function handleCleanBac($id, Request $request)
    {
        if (!$request->input('status') || !$request->input('userId')) {
            return response()->json(['status' => 400]);
        }
        $checkBac = Bac::find($id);
        if (!$checkBac) {
            return response()->json(['status' => 404, 'Bac not found']);

        }

        $checkUser = User::find($request->input('userId'));
        if (!$checkUser) {
            return response()->json(['status' => 404, 'user' => 'User not found']);

        }

        if ($checkBac) {

            $checkBac->update([
                'status' => $request->input('status'),

            ]);
            BacHistory::create([
                'action' => 'vidange',
                'bac_id' => $id,
                'user_id' => $request->input('userId'),
            ]);

        }
        return response()->json(['status' => 200]);

    }

    public function handleRefillBac($id, Request $request)
    {
        if (!$request->input('refillDate') || !$request->input('status') || !$request->input('userId')) {
            return response()->json(['status' => 400]);
        }

        $validatedData = $request->validate([
            'refillDate' => 'date_format:Y-m-d H:i:s',
        ]);

        $checkUser = User::find($request->input('userId'));
        if (!$checkUser) {
            return response()->json(['status' => 404, 'user' => 'User not found']);

        }

        if ($request->input('productId')) {
            $checkProduct = Product::find($request->input('productId'));
            if (!$checkProduct) {
                return response()->json(['status' => 404,'product' => 'Product not found']);

            }
        }

        $checkBac = Bac::find($id);
        if (!$checkBac) {
            return response()->json(['status' => 404,'Bac' => 'Bac not found']);

        }
        if ($checkBac) {

            $checkBac->update([
                'last_refill_time' => $request->input('refillDate'),
                'status' => $request->input('status'),
                'product_id' => $request->input('productId') ? $request->input('productId') : $checkBac->product_id,
            ]);
            BacHistory::create([
                'action' => 'Recharge',
                'bac_id' => $id,
                'user_id' => $request->input('userId'),
            ]);

        }
        return response()->json(['status' => 200]);

    }

}
