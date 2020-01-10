<?php

Route::group(['module' => 'Warehouse', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Warehouse\Controllers\api'], function() {

    Route::get('/api/warehouse/products/{id}', 'WarehouseController@handleGetWarehouseProducts');
    Route::post('/api/warehouse/product/add', 'WarehouseController@handleAddWarehouseProduct');
});
