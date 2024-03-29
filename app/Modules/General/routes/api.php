<?php

Route::group(['module' => 'General', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\General\Controllers\api'], function() {
Route::post('/country/add','GeneralController@handleAddCountryData');
Route::post('/country/update/{id}','GeneralController@handleUpdateCountryData');
Route::get('/country/cities/{id}','GeneralController@handleGetCountryCities'); 
Route::get('/zipcode/{id}','GeneralController@handleGetZipcodes'); 
Route::post('/zipcode/delete/{id}','GeneralController@handleDeleteZipCode'); 
Route::post('/zipcode/update/{id}','GeneralController@handleUpdateZipCode'); 
Route::get('/city/{id}','GeneralController@handleGetCityZipcodes');
Route::get('/city/companies/{id}','GeneralController@handleGetCityCompanies');
Route::post('/city/delete/{id}','GeneralController@handleDeleteCity');
Route::post('/api/photos/upload', 'GeneralController@handleUploadAdvertisement');
Route::get('/api/photos/all', 'GeneralController@handleGetAllAds');
Route::get('/api/photo/{id}', 'GeneralController@handleRemoveAdd');
Route::get('/api/photo/name/{name}', 'GeneralController@handleRemoveAdByName');
});





