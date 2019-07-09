<?php

Route::group(['module' => 'Store', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Store\Controllers'], function() {

    Route::get('/stores/{id}', 'StoreController@showStores')->name('showStores');
    Route::get('/store/add/{id}', 'StoreController@showAddStore')->name('showAddStore');
});
