<?php

Route::group(['module' => 'Mixture', 'middleware' => ['web'], 'namespace' => 'App\Modules\Mixture\Controllers'], function() {

    Route::resource('Mixture', 'MixtureController');

});
