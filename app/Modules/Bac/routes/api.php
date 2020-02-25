<?php

Route::group(['module' => 'Bac', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Bac\Controllers\api'], function() {

    //Route::resource('Bac', 'BacController');
    Route::get('api/bac/{id}', 'BacController@handleGetBacDetails');
    Route::post('api/bac/fill/{id}', 'BacController@handleFillBacWithProduct'); // Fill a bac with a new product
    Route::post('api/xbacs', 'BacController@storeAll');
    Route::post('api/bac/clean/{id}', 'BacController@handleCleanBac');
    Route::post('api/bac/refill/{id}', 'BacController@handleRefillBac');
    
});
