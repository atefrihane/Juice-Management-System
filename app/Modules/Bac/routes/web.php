<?php

Route::group(['module' => 'Bac', 'middleware' => ['web'], 'namespace' => 'App\Modules\Bac\Controllers'], function() {

    Route::resource('Bac', 'BacController');

});
