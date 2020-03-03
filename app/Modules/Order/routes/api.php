<?php

Route::group(['module' => 'Order', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Order\Controllers\api'], function () {
    Route::get('/api/order/{id}', 'OrderController@showOrder');
    Route::get('/api/order/store/{id}', 'OrderController@showOrderByStore');
    Route::get('/api/order/prepared/{id}', 'OrderController@showOrderPrepared');
    Route::post('/api/order/product/delete/{id}', 'OrderController@handleDeleteProduct');
    Route::post('/api/order/product/update/{id}', 'OrderController@handleUpdateProduct');
    Route::post('/api/order/save', 'OrderController@handleSaveOrder');
    Route::post('/api/order/toprepare/{id}/', 'OrderController@handleUpdateOrderToPrepare'); // set preparator..
    Route::post('/api/order/{id}/prepare', 'OrderController@handleOrderPreparedProducts')->name('handleOrderPreparedProducts'); //save prepared products
    Route::post('/api/order/{id}/prepare/delete', 'OrderController@handleDeleteOrderPrepare')->name('handleDeleteOrderPrepare'); // delete prepared product
    Route::post('/api/order/{id}/prepare/submit', 'OrderController@handleSubmitOrderInPrepare')->name('handleSubmitOrderInPrepare'); // submit order after preparation
    Route::post('/api/order/{id}/prepare/after', 'OrderController@handleSubmitOrderAfterPrepare')->name('handleSubmitOrderAfterPrepare'); // submit status after prepared
    Route::post('/api/order/history/{id}', 'OrderController@handleUpdateHistory')->name('handleUpdateHistory');
    Route::post('order/delivery/{id}', 'OrderController@handleUpdateDeliveryOrder')->name('handleUpdateDeliveryOrder');
    Route::post('/api/order/{id}/confirm', 'OrderController@handleConfirmOrder');

});
