<?php

Route::group(['module' => 'Diractor', 'middleware' => ['api'], 'namespace' => 'App\Modules\Diractor\Controllers'], function() {

    Route::resource('Diractor', 'DiractorController');

});
