<?php

Route::group(['module' => 'Diractor', 'middleware' => ['web'], 'namespace' => 'App\Modules\Diractor\Controllers'], function() {

    Route::resource('Diractor', 'DiractorController');

});
