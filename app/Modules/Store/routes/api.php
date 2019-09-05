<?php

Route::group(['module' => 'Store', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Store\Controllers\api'], function() {

    Route::get('api/stores/{id}', 'StoreController@show');

});
