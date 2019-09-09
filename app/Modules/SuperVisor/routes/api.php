<?php

Route::group(['module' => 'SuperVisor', 'middleware' => ['api'], 'namespace' => 'App\Modules\SuperVisor\Controllers'], function() {

    Route::resource('SuperVisor', 'SuperVisorController');

});
