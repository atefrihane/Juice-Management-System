<?php

namespace App\Modules\Bac\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\BacHistory\Models\BacHistory;
use App\Modules\Bac\Models\Bac;
use App\Modules\Bac\Models\BacProduct;
use App\Modules\Bac\Models\BacProductFilled;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\StoreProduct;
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
        $bac = Bac::find($id);
        $checkBacProducts = BacProduct::where('bac_id', $id)
            ->with('product')
            ->withCount(['productsInStock as countUnits' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }])
            ->get();

        if ($bac) {
            return response()->json(['status' => 200, 'bac' => $bac, 'bacDetails' => $checkBacProducts,
            ]);

        }
        return response()->json(['status' => 404]);

    }
    public function handleFillBacWithProducts(Request $request, $id)
    {

        if (!$request->filled('products') ||
            !$request->filled('filledProducts') ||
            (count($request->input('filledProducts')) == 0)
        ) {
            return response()->json(['status' => 400]);

        }

        $wrongKeys = false;
        foreach ($request->input('filledProducts') as $stockProduct) {
            if (!array_key_exists("quantity", $stockProduct) ||
                !array_key_exists("store_products_id", $stockProduct) ||
                !array_key_exists("product_id", $stockProduct)
            ) {
                $wrongKeys = true;
            }
        }
        if ($wrongKeys) {
            return response()->json(['status' => 404, 'Stock' => 'Wrong Stock products keys']);
        }

        $wrongKeys = false;
        foreach ($request->input('products') as $product) {
            if (!array_key_exists("expiration_date", $product) ||
                !array_key_exists("product_id", $product)
            ) {
                $wrongKeys = true;
            }
        }
        if ($wrongKeys) {
            return response()->json(['status' => 404, 'Products' => 'Wrong  products keys']);
        }

        //Verify if products passed already exist
        $productIdsRequested = array_column($request->products, 'product_id');
        $checkProductsIds = Product::whereIn('id', $productIdsRequested)->pluck('id')->toArray();

        $checkProductsExistance = array_diff($productIdsRequested, $checkProductsIds);
        if (count($checkProductsExistance) > 0) {
            return response()->json(['status' => 404, 'productsIdsNotFound' => array_values($checkProductsExistance)]);
        }

        //Verify if stock products passed already exist

        $storeProductIdsRequested = array_column($request->filledProducts, 'store_products_id');
        $checkStoreProductIdsRequested = StoreProduct::whereIn('id', $storeProductIdsRequested)->pluck('id')->toArray();
        if (count($checkStoreProductIdsRequested) == 0) {
            return response()->json(['status' => 404, 'stockproductsNotFound' => array_values($storeProductIdsRequested)]);
        }
        $checkStoreProductIdsExistance = array_diff($storeProductIdsRequested, $checkStoreProductIdsRequested);

        if (count($checkStoreProductIdsExistance) > 0) {
            return response()->json(['status' => 404, 'stockproductsNotFound' => array_values($checkStoreProductIdsExistance)]);
        }

        $checkBac = Bac::find($id);

        if ($checkBac) {

            $checkBac->products()->attach($request->products);
            $getProductsInBacs = DB::table('bac_products')->whereIn('product_id', $productIdsRequested)
                ->where('bac_id', $checkBac->id)
                ->get()->toArray();
            $bacProductsFilled = [];
            foreach ($getProductsInBacs as $productInBac) {
                foreach ($request->input('filledProducts') as $filled) {

                    if ($filled['product_id'] == $productInBac->product_id) {
                        $bacProductFilled = [
                            'quantity' => $filled['quantity'],
                            'bac_products_id' => $productInBac->id,
                            'store_products_id' => $filled['store_products_id'],
                        ];
                        array_push($bacProductsFilled, $bacProductFilled);
                    }

                }
            }
            //check stock to validate upcoming quantities
            $stockIds = array_column($bacProductsFilled, 'store_products_id');
            $allStock = StoreProduct::whereIn('id', $stockIds)->get();
            $updatedStock = [];
            foreach ($allStock as $stock) {
                foreach ($bacProductsFilled as $productFilled) {
                    if ($stock->id == $productFilled['store_products_id'] && $productFilled['quantity'] > $stock->quantity) {
                        return response()->json(['status' => 404,
                            'store_products_id' => $productFilled['store_products_id'],
                            'quantityError' => $productFilled['quantity'],
                            'maxStockQuantity' => $stock->quantity,
                        ]);

                    } else if ($stock->id == $productFilled['store_products_id'] && $productFilled['quantity'] <= $stock->quantity) {
                        array_push($updatedStock, [
                            'id' => $productFilled['store_products_id'],
                            'quantity' => $stock->quantity - $productFilled['quantity'],
                        ]);
                    }

                }
            }

            BacProductFilled::insert($bacProductsFilled);
            $stockInstance = new StoreProduct;

            $index = 'id';

            \Batch::update($stockInstance, $updatedStock, $index);

            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404, 'Bac' => 'Bac not found']);

    }

}
