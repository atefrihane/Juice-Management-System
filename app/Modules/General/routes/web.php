<?php

Route::group(['module' => 'General', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\General\Controllers'], function() {

Route::get('/','GeneralController@showHome')->name('showHome');
Route::get('/static','GeneralController@showStaticManagement')->name('showStaticManagement');
Route::get('/countries/add','GeneralController@showAddCountry')->name('showAddCountry');
Route::get('/country/update/{id}','GeneralController@showUpdateCountry')->name('showUpdateCountry');
Route::post('/country/delete/{id}','GeneralController@handleDeleteCountry')->name('handleDeleteCountry');
});



