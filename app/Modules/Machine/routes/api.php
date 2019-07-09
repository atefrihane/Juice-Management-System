<?php

Route::group(['module' => 'Machine', 'middleware' => ['api'], 'namespace' => 'App\Modules\Machine\Controllers'], function() {

    Route::resource('Machine', 'MachineController');

});
