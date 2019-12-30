<?php

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'primary.admin'], 'namespace' => 'App\Modules\Machine\Controllers'], function () {

    Route::get('machine/add', 'MachineController@showAddMachine')->name('showAddMachine');
    Route::get('machine/edit/{id}', 'MachineController@edit')->name('editMachine');
    route::get('machine/rental/{id}', 'MachineController@startRentalMachine')->name('startRental');
    route::get('machines/rental', 'MachineController@showStartRentalMachines')->name('showStartRentalMachines');
});

Route::group(['module' => 'Machine', 'middleware' => ['web', 'isAuth'], 'namespace' => 'App\Modules\Machine\Controllers'], function () {

    Route::get('machines', 'MachineController@showMachines')->name('showMachines');
    Route::get('machines/rented/{id}', 'MachineController@showRentedMachines')->name('showRentedMachines');
    Route::get('machine/history/{id}', 'MachineController@showHistoryMachine')->name('showHistoryMachine');
    Route::post('machine/store', 'MachineController@store')->name('storeMachine');
    Route::post('machine/update/{id}', 'MachineController@update')->name('updateMachine');
    Route::post('machine/state/update/{id}', 'MachineController@handleUpdateState')->name('handleUpdateState');
    route::post('machine/delete/{id}', 'MachineController@delete')->name('deleteMachine');

});
