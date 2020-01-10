<?php

Route::group(['module' => 'Store', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Store\Controllers\api'], function() {

    Route::get('api/stores/{id}', 'StoreController@show');

});


Route::group(['module' => 'Store', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Store\Controllers\api'], function() {
    Route::get('api/stores', 'StoreController@showStores');
    Route::get('api/store/{id}', 'StoreController@showStore');

});

