<?php

Route::group(['module' => 'Machine', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Machine\Controllers'], function() {

    Route::get('machines', 'MachineController@showMachines')->name('showMachines');
    Route::get('machines/rented/{id}', 'MachineController@showRentedMachines')->name('showRentedMachines');
    Route::get('machine/add', 'MachineController@showAddMachine')->name('showAddMachine');
});
