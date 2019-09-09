<?php

Route::group(['module' => 'BacHistory', 'middleware' => ['api'], 'namespace' => 'App\Modules\BacHistory\Controllers'], function() {

    Route::resource('BacHistory', 'BacHistoryController');

});
