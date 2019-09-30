<?php

Route::group(['module' => 'MachineRental', 'middleware' => ['web'], 'namespace' => 'App\Modules\MachineRental\Controllers'], function() {

//    Route::resource('MachineRental', 'MachineRentalController');
    Route::get('machine/rental/show/{id}', 'MachineRentalController@show')->name('showRental');
    Route::get('machine/rental/edit/{id}', 'MachineRentalController@showEditRental')->name('showEditRental');
    Route::get('machine/rental/list/{id}', 'MachineRentalController@showAllRentals')->name('showListRental');
    Route::get('machine/rental/show/end/{id}', 'MachineRentalController@endMachineRental')->name('showEndRental');
    Route::post('machine/rental/end/{id}', 'MachineRentalController@endRental')->name('endRental');
});
