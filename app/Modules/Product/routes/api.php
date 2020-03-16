<?php

Route::group(['module' => 'Product', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Product\Controllers\api'], function () {

    //  Route::resource('Product', 'ProductController');
    route::post('api/products', 'ProductController@store');
    route::post('api/product/update/{id}', 'ProductController@handleUpdateProduct');
    route::get('api/products', 'ProductController@index');
    route::get('api/products/categorized', 'ProductController@showProductsCategorized');
    // route::get('api/product/{id}/store/{store_id}', 'ProductController@handleGetProductById'); //
    route::post('api/product/prices/{id}', 'ProductController@handleGetProductPrices'); //returns product details with specific price
    route::get('api/product/filter/{value}', 'ProductController@handleFilterProductByNameOrBarcode');
    route::get('api/product/barcode/{barcode}', 'ProductController@handleFilterProductByBarcode');
    route::get('api/products/all', 'ProductController@handleGetAllProduct');
    route::post('api/image', 'ProductController@handleUploadImage');
    route::get('api/product/warehouses/{id}', 'ProductController@handleGetProductInWarehouses'); //returns occurence of product in all warehouses
    route::post('api/check/warehouses/{id}', 'ProductController@handleCheckQuantityInWarehouses'); //returns occurence of product in all warehouses
    route::get('api/product/details/{id}', 'ProductController@handleGetProductDetails'); //returns product details without specific price
    route::post('api/product/{id}/validity', 'ProductController@handleGetValidityAfterOpening'); //returns validity days
    route::get('api/product/{id}/before', 'ProductController@handleCheckProductBeforeUpdate'); //returns if product exists in orders ' en cours de saisie'
    route::get('api/store/{id}/stock', 'ProductController@handleGetProductsByStore'); // show stock of products linked to a specific store
    route::get('api/product/{id}/store/{store_id}', 'ProductController@handleGetProductInStores'); //returns occurence of a product in stock of a store
    route::post('api/product/{id}/store/{store_id}', 'ProductController@handleStoreProductInStock'); //add a new product to a specific store stock
    route::post('api/stock/{id}/update', 'ProductController@handleUpdateStoreProductStock'); //update a  product of a specific store stock
    route::post('api/stock/{id}/empty', 'ProductController@handleEmptyStoreProductStock'); //empty  a  product of a specific store stock

});
