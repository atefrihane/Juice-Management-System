<?php

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'preparator'], 'namespace' => 'App\Modules\Order\Controllers'], function () {
    Route::get('order/add', 'OrderController@showAddOrder')->name('showAddOrder');
    
});

// routes below won't be accessed only if user is authenticated
Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth'], 'namespace' => 'App\Modules\Order\Controllers'], function () {

    Route::get('orders', 'OrderController@showOrders')->name('showOrders');
    Route::post('order/archive/{id}', 'OrderController@handleArchiveOrder')->name('handleArchiveOrder');
    Route::post('order/delete/{id}', 'OrderController@handleDeleteOrder')->name('handleDeleteOrder');

});

// routes below won't be accessed only if the upcoming order has a status > 1
Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth', 'order.detail','order.access'], 'namespace' => 'App\Modules\Order\Controllers'], function () {

    Route::get('/order/{id}', 'OrderController@showOrder')->name('showOrder');

});

// routes below won't be accessed only if the upcoming order has a status > 2 && status == 12 (canceled)
Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth', 'order.update.status','order.access'], 'namespace' => 'App\Modules\Order\Controllers'], function () {

    Route::get('/order/{id}/status', 'OrderController@showUpdateStatusOrder')->name('showUpdateStatusOrder');
    Route::get('/order/{id}/prepare', 'OrderController@showOrderPreparedProducts')->name('showOrderPreparedProducts');

});

// routes below won't be accessed only if the upcoming order has a status < 2
Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth', 'order.update','preparator'], 'namespace' => 'App\Modules\Order\Controllers'], function () {
    Route::get('order/update/{id}', 'OrderController@showUpdateOrder')->name('showUpdateOrder');

});

// routes below won't be accessed only if the upcoming order has a status >= 4  || status <=7 ( Delivery_mode)

Route::group(['module' => 'Order', 'middleware' => ['web', 'isAuth', 'order.delivery','order.access'], 'namespace' => 'App\Modules\Order\Controllers'], function () {

    Route::get('order/delivery/{id}', 'OrderController@showUpdateDeliveryOrder')->name('showUpdateDeliveryOrder');

});
