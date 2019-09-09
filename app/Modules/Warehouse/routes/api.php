<?php

Route::group(['module' => 'Warehouse', 'middleware' => ['api'], 'namespace' => 'App\Modules\Warehouse\Controllers'], function() {

    Route::resource('Warehouse', 'WarehouseController');

});
