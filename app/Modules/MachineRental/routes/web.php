<?php


Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'primary.admin'], 'namespace' => 'App\Modules\MachineRental\Controllers'], function () {

    Route::get('machine/rental/edit/{id}', 'MachineRentalController@showEditRental')->name('showEditRental');
    Route::get('machine/rental/show/end/{id}', 'MachineRentalController@endMachineRental')->name('showEndRental');
});

Route::group(['module' => 'MachineRental', 'middleware' => ['web'], 'namespace' => 'App\Modules\MachineRental\Controllers'], function() {

//    Route::resource('MachineRental', 'MachineRentalController');
    Route::get('machine/rental/show/{id}', 'MachineRentalController@show')->name('showRental');
    Route::get('machine/rental/list/{id}', 'MachineRentalController@showAllRentals')->name('showListRental');
    Route::post('machine/rental/end/{id}', 'MachineRentalController@endRental')->name('endRental');
    Route::post('machine/history/edit/{id}', 'MachineRentalController@handleEditRental')->name('handleEditRental');
});
