<?php

Route::group(['module' => 'MachineRental', 'middleware' => ['api'], 'namespace' => 'App\Modules\MachineRental\Controllers'], function() {

    Route::resource('MachineRental', 'MachineRentalController');

});
