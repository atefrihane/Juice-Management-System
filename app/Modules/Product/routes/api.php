<?php

Route::group(['module' => 'Product', 'middleware' => ['api'], 'namespace' => 'App\Modules\Product\Controllers\api'], function() {

  //  Route::resource('Product', 'ProductController');
    route::post('api/products', 'ProductController@store');
    route::post('api/product/update/{id}', 'ProductController@handleUpdateProduct');
    route::get('api/products', 'ProductController@index');
    route::get('api/product/{id}', 'ProductController@handleGetProductById'); //returns mixtures
    
    route::get('api/product/details/{id}', 'ProductController@handleGetProductDetails');
    route::get('api/product/name/{name}', 'ProductController@handleGetProductByName');
    route::get('api/product/barcode/{barcode}', 'ProductController@handleGetProductByBarcode');
    route::get('api/products/all', 'ProductController@handleGetAllProduct');
    route::post('api/image', 'ProductController@handleUploadImage');
    route::get('api/product/warehouses/{id}', 'ProductController@handleGetProductInWarehouses'); //returns occurence of product in all warehouses
});
