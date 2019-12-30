<?php

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth','primary.admin'], 'namespace' => 'App\Modules\Store\Controllers'], function () {

    Route::get('company/{company_id}/stores/{store_id}/stock/add', 'StoreController@showAddStoreStock')->name('showAddStoreStock');
    Route::get('company/{company_id}/stores/{store_id}/stock/update/{stock_id}', 'StoreController@showUpdateStoreStock')->name('showUpdateStoreStock');
    Route::get('company/{company_id}/addStore', 'StoreController@showAddStore')->name('showAddStore');
    Route::get('store/{id}/edit','StoreController@edit')->name('editStore');
});


Route::group(['module' => 'Store', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Store\Controllers'], function() {

    Route::get('company/{company_id}/stores', 'StoreController@showStores')->name('showStores');
    Route::post('store/delete/{id}', 'StoreController@delete')->name('deleteStore');
    Route::post('company/{company_id}/store/add', 'StoreController@store')->name('addStore');
    Route::post('store/{id}/update', 'StoreController@update')->name('updateStore');
    Route::get('company/{company_id}/stores/{store_id}', 'StoreController@showStore')->name('showStore');
    Route::get('company/{company_id}/stores/{store_id}/rentals', 'StoreController@showStoreRentals')->name('showStoreRentals');
    Route::get('company/{company_id}/stores/{store_id}/stock', 'StoreController@showStoreStock')->name('showStoreStock');
    Route::post('company/{company_id}/stores/{store_id}/stock/add', 'StoreController@handleAddStoreStock')->name('handleAddStoreStock');
    Route::post('company/{company_id}/stores/{store_id}/stock/update/{id}', 'StoreController@handleUpdateStoreStock')->name('handleUpdateStoreStock');
    Route::post('/stock/delete/{id}', 'StoreController@handleDeleteStock')->name('handleDeleteStock');
});

