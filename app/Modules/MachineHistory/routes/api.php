<?php

Route::group(['module' => 'MachineHistory', 'middleware' => ['api'], 'namespace' => 'App\Modules\MachineHistory\Controllers'], function() {

    Route::resource('MachineHistory', 'MachineHistoryController');

});
