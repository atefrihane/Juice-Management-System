<?php

Route::group(['module' => 'Bac', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Bac\Controllers\api'], function () {

    //Route::resource('Bac', 'BacController');
    Route::get('api/bac/{id}', 'BacController@handleGetBacDetails');
    Route::get('api/bac/{id}/product/{product_id}/quantities', 'BacController@handleGetQuantitiesFilledInBac');
    Route::post('api/bac/fill/{id}', 'BacController@handleFillBacWithProducts'); // Fill a bac with  new products
    Route::post('api/bac/{id}/clean', 'BacController@handleCleanBacs');
    Route::post('api/bac/refill/{id}', 'BacController@handleRefillBac');
    Route::post('api/bac/state/{id}', 'BacController@handleUpdateBacStatut');
});
