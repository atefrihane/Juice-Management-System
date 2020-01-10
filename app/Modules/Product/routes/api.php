<?php

Route::group(['module' => 'Product', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Product\Controllers\api'], function() {

  //  Route::resource('Product', 'ProductController');
    route::post('api/products', 'ProductController@store');
    route::post('api/product/update/{id}', 'ProductController@handleUpdateProduct');
    route::get('api/products', 'ProductController@index');
    route::get('api/product/{id}', 'ProductController@handleGetProductById'); //returns mixtures
    route::post('api/product/{id}/validity', 'ProductController@handleGetValidityAfterOpening'); //returns validity days
    route::get('api/product/details/{id}', 'ProductController@handleGetProductDetails'); //returns product details without specific price
    route::post('api/product/prices/{id}', 'ProductController@handleGetProductPrices'); //returns product details with specific price
    route::get('api/product/name/{name}', 'ProductController@handleGetProductByName');
    route::get('api/product/barcode/{barcode}', 'ProductController@handleGetProductByBarcode');
    route::get('api/products/all', 'ProductController@handleGetAllProduct');
    route::post('api/image', 'ProductController@handleUploadImage');
    route::get('api/product/warehouses/{id}', 'ProductController@handleGetProductInWarehouses'); //returns occurence of product in all warehouses
    route::post('api/check/warehouses/{id}', 'ProductController@handleCheckQuantityInWarehouses'); //returns occurence of product in all warehouses
});
