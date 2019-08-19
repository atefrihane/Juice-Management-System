<?php

Route::group(['module' => 'Product', 'middleware' => ['api'], 'namespace' => 'App\Modules\Product\Controllers\api'], function() {

    Route::post('api/products', 'ProductController@store');
    Route::get('api/products', 'ProductController@index');
    Route::post('api/product/price','ProductController@handleAddProduct');
});
