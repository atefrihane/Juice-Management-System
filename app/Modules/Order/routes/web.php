<?php

Route::group(['module' => 'Order', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Order\Controllers'], function() {

    Route::get('orders', 'OrderController@showOrders')->name('showOrders');
    Route::get('order/add', 'OrderController@showAddOrder')->name('showAddOrder');
    Route::get('order/update/{id}', 'OrderController@showUpdateOrder')->name('showUpdateOrder');
    Route::post('order/delete/{id}', 'OrderController@handleDeleteOrder')->name('handleDeleteOrder');
});
