<?php

Route::group(['module' => 'Warehouse', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Warehouse\Controllers'], function() {

   Route::get('/warehouse/products','WarehouseController@showWarehouseProducts')->name('showWarehouseProducts');
   Route::get('/warehouses','WarehouseController@showWarehouses')->name('showWarehouses');
   Route::get('/product/quantity','WarehouseController@showAddProductQuantity')->name('showAddProductQuantity');
   Route::get('/warehouse/add','WarehouseController@showAddWarehouse')->name('showAddWarehouse');
   Route::get('/warehouse/detail','WarehouseController@showWarehouseDetail')->name('showWarehouseDetail');
});
