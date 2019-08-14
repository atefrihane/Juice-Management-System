<?php

Route::group(['module' => 'Company', 'middleware' => ['api'], 'namespace' => 'App\Modules\Company\Controllers\api'], function() {

    //Route::prefix('api')->resource('Company', 'CompanyController');
    Route::get('api/companies/{id}', 'CompanyController@show');
});
