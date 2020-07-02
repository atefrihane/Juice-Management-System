<?php
Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth','primary.admin'], 'namespace' => 'App\Modules\Company\Controllers'], function () {

    Route::get('/company/add', 'CompanyController@showAddCompany')->name('showAddCompany');
    Route::get('/company/edit/{id}', 'CompanyController@edit')->name('editCompany');

});

Route::group(['module' => 'Company', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Company\Controllers'], function () {
    Route::get('/companies', 'CompanyController@showCompanies')->name('showCompanies');
    Route::post('/company/add', 'CompanyController@handleAddCompany')->name('handleAddCompany');
    Route::post('/company/update/{id}', 'CompanyController@update')->name('updateCompany');
    Route::get('/company/{id}', 'CompanyController@showCompany')->name('showCompany');
    Route::post('/company/delete/{id}', 'CompanyController@destroy')->name('deleteCompany');

});


