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
        if (
            !$request->filled('updatedStock') ||
            empty($request->updatedStock) ||
            !$request->filled('userId') ||
            !$request->filled('storeId') ||
            !$request->filled('productId')
        ) {
            return response()->json(['status' => 400]);

        }

        $wrongKeys = false;
        foreach ($request->input('updatedStock') as $stockProduct) {
            if (!array_key_exists("quantity", $stockProduct) ||
                !array_key_exists("id", $stockProduct)

            ) {
                $wrongKeys = true;
            }
        }
        if ($wrongKeys) {
            return response()->json(['status' => 404, 'updatedStock' => 'updatedStock keys wrong']);

        }
        $checkBac = Bac::find($id);
        if ($checkBac) {
            $allStock = StoreProduct::where('store_id', $request->input('storeId'))->get();
            if (empty($allStock)) {
                return response()->json(['status' => 404, 'Stock' => 'Stock is empty']);

            }
            $productInBac = DB::table('bac_products')
                ->where('product_id', $request->input('productId'))
                ->where('bac_id', $checkBac->id)
                ->first();
            if (!$productInBac) {
                return response()->json(['status' => 404, 'Product' => 'Product not found']);

            }
         

            // check stock and update it
            $newUpdatedStock = [];
            $newFilledProducts = []; // new instances of product
            $unavailableStock = []; // Unsufficient quantity of product
            foreach ($allStock as $stock) {
                foreach ($request->updatedStock as $updatedStock) {

                    if ($stock->id == $updatedStock['id'] && $stock->quantity >= $updatedStock['quantity']) {

                        array_push($newUpdatedStock, ['id' => $stock->id, 'quantity' => $stock->quantity - $updatedStock['quantity']]);
                        array_push($newFilledProducts, [
                            'quantity' => $updatedStock['quantity'],
                            'bac_products_id' => $productInBac->id,
                            'store_products_id' => $stock->id,
                        ]);
                    } else if ($stock->id == $updatedStock['id'] && $stock->quantity < $updatedStock['quantity']) {

                        array_push($unavailableStock, ['id' => $stock->id, 'stockQuantity' => $stock->quantity]);

                    }
                }
            }

            if (!empty($newUpdatedStock)) {
                $stockInstance = new StoreProduct;

                $index = 'id';

                \Batch::update($stockInstance, $newUpdatedStock, $index);

            }
            $updatedProductInstances = [];
            $newProductInstances = [];
            $productInstancesIds = array_column($newFilledProducts, 'bac_products_id');
            $allInstancesOfProducts = BacProductFilled::whereIn('bac_products_id', $productInstancesIds)->get();

            if (!empty($allInstancesOfProducts)) {
                foreach ($allInstancesOfProducts as $productInstance) {
                    foreach ($newFilledProducts as $newFilled) {
                        if ($newFilled['bac_products_id'] == $productInstance->bac_products_id) {
                            array_push($updatedProductInstances, [
                                'quantity' => $productInstance->quantity += $newFilled['quantity'],
                                'id' => $productInstance->id,
                            ]);

                        } else {
                            array_push($newProductInstances, [
                                'quantity' => $updatedStock['quantity'],
                                'bac_products_id' => $productInstance->bac_products_id,
                                'store_products_id' => $updatedStock['id'],
                            ]);

                        }

                    }
                }

            }

            if (!empty($newProductInstances)) {
                BacProductFilled::insert($newProductInstances);

            }

            if (!empty($updatedProductInstances)) {
              
                $stockProductInstance = new BacProductFilled;

                $index = 'id';

                \Batch::update($stockProductInstance, $updatedProductInstances, $index);

            }

            $currentLocation = $checkBac->machine->currentLocation()->id;
            BacHistory::create([
                'user_id' => $request->input('userId'),
                'bac_id' => $checkBac->id,
                'action' => 'Modification quantité produit',
                'machine_rental_id' => $currentLocation,

            ]);

            return response()->json(['status' => 200, 'unsufficientStock' => $unavailableStock]);

        }
        return response()->json(['status' => 404]);

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
            (count($request->input('filledProducts')) == 0) ||
            !$request->filled('userId')
        ) {
            return response()->json(['status' => 400]);

        }
        $checkUser = User::find($request->input('userId'));
        if (!$checkUser) {
            return response()->json(['status' => 404, 'User' => 'User not found']);
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

        if ($request->has('bacUpdates')) {
            $wrongKeys = false;

            if (!array_key_exists("final_amount", $request->input('bacUpdates')) ||
                !array_key_exists("needed_weight", $request->input('bacUpdates')) ||
                !array_key_exists("water_amount", $request->input('bacUpdates')) ||
                !array_key_exists("sugar_amount", $request->input('bacUpdates')) ||
                !array_key_exists("type", $request->input('bacUpdates')) ||
                !array_key_exists("glass_size", $request->input('bacUpdates'))
            ) {
                $wrongKeys = true;
            }

            if ($wrongKeys) {
                return response()->json(['status' => 404, 'Products' => 'Wrong  bacUpdates keys']);
            }
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
            //Check if bac has already products to avoid dupplication
            if (!$checkBac->products()->exists()) {
                $checkBac->products()->attach($request->products);
            }

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

            $checkExistingProductsInstances = DB::table('bac_products_filled')
                ->whereIn('bac_products_id', array_column($getProductsInBacs, 'id'))
                ->get()->toArray();

            //Check is bac_products already has filled products
            if (empty($checkExistingProductsInstances)) {

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
                //Update Bac details
                if ($request->filled('bacUpdates')) {
                    $checkBac->update($request->input('bacUpdates'));
                }

            }
            $currentLocation = $checkBac->machine->currentLocation()->id;
            BacHistory::create([
                'user_id' => $request->input('userId'),
                'bac_id' => $checkBac->id,
                'action' => 'Recharge',
                'machine_rental_id' => $currentLocation,

            ]);
            $latestExpiration = DB::table('bac_products')
                ->where('bac_id', $checkBac->id)
                ->min('expiration_date');

            return response()->json(['status' => 200, 'latestExpiration' => $latestExpiration]);

        }
        return response()->json(['status' => 404, 'Bac' => 'Bac not found']);

    }

}
