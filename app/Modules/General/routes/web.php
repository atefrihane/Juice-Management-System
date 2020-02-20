<?php

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'primary.admin'], 'namespace' => 'App\Modules\General\Controllers'], function () {

    Route::get('/countries/add', 'GeneralController@showAddCountry')->name('showAddCountry');
    Route::get('/country/update/{id}', 'GeneralController@showUpdateCountry')->name('showUpdateCountry');
    Route::get('/advertisement/add', 'GeneralController@showAddAdvertisement')->name('showAddAdvertisement');
});

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'preparator'], 'namespace' => 'App\Modules\General\Controllers'], function () {

    Route::get('/archives', 'GeneralController@showArchives')->name('showArchives');
});

Route::group(['module' => 'General', 'middleware' => ['web', 'isAuth'], 'namespace' => 'App\Modules\General\Controllers'], function () {

    Route::get('/', 'GeneralController@showHome')->name('showHome');
    Route::get('/static', 'GeneralController@showStaticManagement')->name('showStaticManagement');
    Route::post('/country/delete/{id}', 'GeneralController@handleDeleteCountry')->name('handleDeleteCountry');
  
});
