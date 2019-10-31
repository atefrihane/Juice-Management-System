<?php

Route::group(['module' => 'Order', 'middleware' => ['api'], 'namespace' => 'App\Modules\Order\Controllers\api'], function() {
Route::get('/api/order/{id}','OrderController@showOrder');
Route::post('/api/order/product/delete/{id}','OrderController@handleDeleteProduct');
Route::post('/api/order/product/update/{id}','OrderController@handleUpdateProduct');
Route::post('/api/order/save','OrderController@handleSaveOrder');

});
