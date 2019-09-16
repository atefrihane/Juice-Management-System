<?php

Route::group(['module' => 'Product', 'middleware' => ['api'], 'namespace' => 'App\Modules\Product\Controllers\api'], function() {

  //  Route::resource('Product', 'ProductController');
    route::post('api/products', 'ProductController@store');
    route::get('api/products', 'ProductController@index');
    route::get('api/product/{id}', 'ProductController@handleGetProductById');
    route::get('api/product/name/{name}', 'ProductController@handleGetProductByName');
    route::get('api/product/barcode/{barcode}', 'ProductController@handleGetProductByBarcode');
    route::get('api/products/all', 'ProductController@handleGetAllProduct');
});
