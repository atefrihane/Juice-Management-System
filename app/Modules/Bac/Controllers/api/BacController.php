<?php

namespace App\Modules\Bac\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\BacHistory\Models\BacHistory;
use App\Modules\Bac\Models\Bac;
use App\Modules\Bac\Models\BacProduct;
use App\Modules\Bac\Models\BacProductFilled;
use App\Modules\Product\Models\Product;
use App\Modules\User\Models\User;
use DB;
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
                return response()->json(['status' => 404, 'product' => 'Product not found']);

            }
        }

        $checkBac = Bac::find($id);
        if (!$checkBac) {
            return response()->json(['status' => 404, 'Bac' => 'Bac not found']);

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
    public function handleGetBacDetails($id)
    {

        $checkBacProducts = BacProduct::where('bac_id', $id)
            ->with('product')
            ->withCount(['productsInStock as countUnits' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }])
            ->get();

        if (count($checkBacProducts) > 0) {
            return response()->json(['status' => 200, 'bacDetails' => $checkBacProducts,
            ]);

        }
        return response()->json(['status' => 404]);

    }
    public function handleFillBacWithProduct(Request $request, $id)
    {

        if (!$request->filled('productId') ||
            !$request->filled('stockProducts')) {
            return response()->json(['status' => 400]);

        }

        $checkProduct = Product::find($request->input('productId'));
        if (!$checkProduct) {
            return response()->json(['status' => 404, 'product' => 'Product Not Found']);

        }

        if (count($request->input('stockProducts')) <= 0) {
            return response()->json(['status' => 404, 'Stock' => 'Stock products not found']);
        }

        $wrongKeys = false;
        foreach ($request->input('stockProducts') as $stockProduct) {
            if (!array_key_exists("quantity", $stockProduct) ||
                !array_key_exists("store_products_id", $stockProduct)) {
                $wrongKeys = true;
            }
        }
        if ($wrongKeys) {
            return response()->json(['status' => 404, 'Stock' => 'Wrong array keys']);
        }

        $checkBac = Bac::find($id);

        if ($checkBac) {
            $checkBac->products()->attach($request->input('productId'));
            $bacProductId = $checkBac->products()->wherePivot('product_id', $request->input('productId'))->first()->pivot->id;
            $productsFilled = [];
            foreach ($request->input('stockProducts') as $stockProduct) {
                $productFilled = [
                    'quantity' => $stockProduct['quantity'],
                    'bac_products_id' => $bacProductId,
                    'store_products_id' => $stockProduct['store_products_id'],
                ];
                array_push($productsFilled, $productFilled);

            }

            BacProductFilled::insert($productsFilled);

            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404, 'Bac' => 'Bac not found']);

    }

}
