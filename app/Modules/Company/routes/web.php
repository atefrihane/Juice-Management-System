<?php

Route::group(['module' => 'Company', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Company\Controllers'], function() {

    Route::get('/company/add','CompanyController@showAddCompany')->name('showAddCompany');
    Route::post('/company/add','CompanyController@handleAddCompany')->name('handleAddCompany');
    Route::get('/company/{id}','CompanyController@showCompany')->name('showCompany');

});
