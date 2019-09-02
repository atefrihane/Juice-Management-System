<?php

Route::group(['module' => 'Store', 'middleware' => ['api'], 'namespace' => 'App\Modules\Store\Controllers\api'], function() {

    Route::get('api/stores/{id}', 'StoreController@show');

});
