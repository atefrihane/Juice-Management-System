<?php

Route::group(['module' => 'Store', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Store\Controllers'], function() {
    Route::get('store/{id}/edit','StoreController@edit')->name('editStore');
    Route::get('company/{company_id}/stores', 'StoreController@showStores')->name('showStores');
    Route::get('company/{company_id}/addStore', 'StoreController@showAddStore')->name('showAddStore');
    Route::get('store/delete/{id}', 'StoreController@delete')->name('deleteStore');
    Route::post('company/{company_id}/store/add', 'StoreController@store')->name('addStore');
    Route::post('store/{id}/update', 'StoreController@update')->name('updateStore');

});
