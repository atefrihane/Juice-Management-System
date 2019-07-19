<?php

Route::group(['module' => 'Machine', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Machine\Controllers'], function() {

    Route::get('machines', 'MachineController@showMachines')->name('showMachines');
    Route::get('machines/rented/{id}', 'MachineController@showRentedMachines')->name('showRentedMachines');
    Route::get('machine/add', 'MachineController@showAddMachine')->name('showAddMachine');
    Route::get('machine/edit/{id}', 'MachineController@edit')->name('editMachine');
    Route::post('machine/store', 'MachineController@store')->name('storeMachine');
    Route::post('machine/update/{id}', 'MachineController@update')->name('updateMachine');
    route::get('machine/delete/{id}', 'MachineController@delete')->name('deleteMachine');
});
