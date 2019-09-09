<?php

Route::group(['module' => 'SuperVisor', 'middleware' => ['web'], 'namespace' => 'App\Modules\SuperVisor\Controllers'], function() {

    Route::resource('SuperVisor', 'SuperVisorController');

});
