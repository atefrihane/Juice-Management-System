<?php

Route::group(['module' => 'Bac', 'middleware' => ['api'], 'namespace' => 'App\Modules\Bac\Controllers'], function() {

    Route::resource('Bac', 'BacController');

});
