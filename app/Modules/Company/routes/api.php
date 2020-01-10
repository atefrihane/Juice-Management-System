<?php

Route::group(['module' => 'Company', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Company\Controllers\api'], function() {

    //Route::prefix('api')->resource('Company', 'CompanyController');
    Route::get('api/companies/{id}', 'CompanyController@show');
    Route::get('api/companies', 'CompanyController@index');
    Route::get('api/company/{id}/contacts', 'CompanyController@showContacts');
});
