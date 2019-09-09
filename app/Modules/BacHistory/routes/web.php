<?php

Route::group(['module' => 'BacHistory', 'middleware' => ['web'], 'namespace' => 'App\Modules\BacHistory\Controllers'], function() {

    Route::resource('BacHistory', 'BacHistoryController');

});
