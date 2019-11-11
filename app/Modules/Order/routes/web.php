<?php

// routes below won't be accessed only if user is authenticated
Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth'], 'namespace' => 'App\Modules\Order\Controllers'], function () {

    Route::get('orders', 'OrderController@showOrders')->name('showOrders');
    Route::get('order/add', 'OrderController@showAddOrder')->name('showAddOrder');

});

// routes below won't be accessed only if the upcoming order has a status > 1
Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth', 'order.detail'], 'namespace' => 'App\Modules\Order\Controllers'], function () {

    Route::get('/order/{id}', 'OrderController@showOrder')->name('showOrder');
    Route::get('/order/{id}/status', 'OrderController@showUpdateStatusOrder')->name('showUpdateStatusOrder');
    Route::get('/order/{id}/prepare', 'OrderController@showOrderPreparedProducts')->name('showOrderPreparedProducts');
 
});

// routes below won't be accessed only if the upcoming order has a status < 2
Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth', 'order.update'], 'namespace' => 'App\Modules\Order\Controllers'], function () {
    Route::get('order/update/{id}', 'OrderController@showUpdateOrder')->name('showUpdateOrder');
    Route::post('order/delete/{id}', 'OrderController@handleDeleteOrder')->name('handleDeleteOrder');
});


