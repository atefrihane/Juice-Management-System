<?php

Route::group(['module' => 'CompanyPrice', 'middleware' => ['api'], 'namespace' => 'App\Modules\CompanyPrice\Controllers\api'], function() {

    Route::resource('CompanyPrice', 'CompanyPriceController');

});
