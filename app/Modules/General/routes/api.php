<?php

Route::group(['module' => 'General', 'middleware' => ['api'], 'namespace' => 'App\Modules\General\Controllers\api'], function() {
Route::post('/country/add','GeneralController@handleAddCountryData');
Route::post('/country/update/{id}','GeneralController@handleUpdateCountryData');
Route::get('/country/cities/{id}','GeneralController@handleGetCountryCities'); 
Route::get('/zipcode/{id}','GeneralController@handleGetZipcodes'); 
Route::post('/zipcode/delete/{id}','GeneralController@handleDeleteZipCode'); 
Route::get('/city/{id}','GeneralController@handleGetCityZipcodes');
Route::get('/city/companies/{id}','GeneralController@handleGetCityCompanies');
Route::post('/city/delete/{id}','GeneralController@handleDeleteCity');

});
