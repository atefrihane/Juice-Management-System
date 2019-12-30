<?php

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'primary.admin'], 'namespace' => 'App\Modules\MachineHistory\Controllers'], function () {

  Route::get('machine/status/edit/{id}', 'MachineHistoryController@handleStatusChange')->name('machineStatusEdit');
});

Route::group(['module' => 'MachineHistory', 'middleware' => ['web'], 'namespace' => 'App\Modules\MachineHistory\Controllers'], function() {

  //  Route::resource('MachineHistory', 'MachineHistoryController');
    Route::get('machine/status/edit/{id}', 'MachineHistoryController@handleStatusChange')->name('machineStatusEdit');
    Route::post('/machine/histories/edit/{id}', 'MachineHistoryController@handleHistoryChange')->name('handleHistoryChange');
});
