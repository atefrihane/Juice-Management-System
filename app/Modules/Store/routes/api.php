<?php

Route::group(['module' => 'Store', 'middleware' => ['api'], 'namespace' => 'App\Modules\Store\Controllers'], function() {

    Route::resource('Store', 'StoreController');

});
