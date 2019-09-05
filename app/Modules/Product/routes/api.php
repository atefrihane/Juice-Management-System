<?php

Route::group(['module' => 'Product', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Product\Controllers\api'], function() {

  //  Route::resource('Product', 'ProductController');
    route::post('api/products', 'ProductController@store');
    route::get('api/products', 'ProductController@index');
});
