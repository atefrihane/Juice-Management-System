<?php

Route::group(['module' => 'Bac', 'middleware' => ['api'], 'namespace' => 'App\Modules\Bac\Controllers\api'], function() {

    //Route::resource('Bac', 'BacController');
    Route::post('api/xbacs', 'BacController@storeAll');
});
