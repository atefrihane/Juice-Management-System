<?php

Route::group(['module' => 'MachineRental', 'middleware' => ['web'], 'namespace' => 'App\Modules\MachineRental\Controllers'], function() {

    Route::resource('MachineRental', 'MachineRentalController');

});
