<?php

Route::group(['module' => 'CompanyPrice', 'middleware' => ['api'], 'namespace' => 'App\Modules\CompanyPrice\Controllers'], function() {

    Route::resource('CompanyPrice', 'CompanyPriceController');

});
