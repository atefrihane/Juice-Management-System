<?php

Route::group(['module' => 'MachineHistory', 'middleware' => ['web'], 'namespace' => 'App\Modules\MachineHistory\Controllers'], function() {

    Route::resource('MachineHistory', 'MachineHistoryController');

});
