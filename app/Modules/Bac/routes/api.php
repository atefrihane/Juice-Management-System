<?php

Route::group(['module' => 'Bac', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Bac\Controllers\api'], function() {

    //Route::resource('Bac', 'BacController');
    Route::post('api/xbacs', 'BacController@storeAll');
    Route::post('api/bac/clean/{id}', 'BacController@handleCleanBac');
    Route::post('api/bac/refill/{id}', 'BacController@handleRefillBac');
    
});
