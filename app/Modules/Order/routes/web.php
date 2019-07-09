<?php

Route::group(['module' => 'Order', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Order\Controllers'], function() {

    Route::get('orders', 'OrderController@showOrders')->name('showOrders');
    Route::get('order/add', 'OrderController@showAddOrder')->name('showAddOrder');

});
