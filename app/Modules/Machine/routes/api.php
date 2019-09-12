<?php

Route::group(['module' => 'Machine', 'middleware' => ['api'], 'namespace' => 'App\Modules\Machine\Controllers\api'], function() {

//    Route::resource('Machine', 'MachineController');
    Route::get('api/machines/{id}', 'MachineController@show');
    Route::get('api/machine/states/{id}', 'MachineController@showMachineStates');
});
