<?php

Route::group(['module' => 'MachineRental', 'middleware' => ['api'], 'namespace' => 'App\Modules\MachineRental\Controllers\api'], function() {

   // Route::resource('MachineRental', 'MachineRentalController');
    Route::post('api/rentals', 'MachineRentalController@store');
    Route::post('api/rental/{id}', 'MachineRentalController@handleUpdateRental');
    Route::get('api/rental/{id}', 'MachineRentalController@handleGetRentalData');
});
