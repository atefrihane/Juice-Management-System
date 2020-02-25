<?php

Route::group(['module' => 'Machine', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Machine\Controllers\api'], function() {

//    Route::resource('Machine', 'MachineController');
    Route::get('api/machines/{id}', 'MachineController@show');
    Route::get('api/machine/{machine_id}/rental/{rental_id}', 'MachineController@showMachineStates');
    Route::get('api/machine/bacs/{id}', 'MachineController@showMachineBacs');
    Route::post('api/machine/statut/{id}', 'MachineController@handleMachineStatut');
});
