<?php

Route::group(['module' => 'CompanyPrice', 'middleware' => ['web'], 'namespace' => 'App\Modules\CompanyPrice\Controllers'], function() {

    Route::resource('CompanyPrice', 'CompanyPriceController');

});
