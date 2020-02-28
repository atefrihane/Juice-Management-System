<?php

Route::group(['module' => 'MachineHistory', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\MachineHistory\Controllers\api'], function() {

   route::get('/api/machine/{id}/history','MachineHistoryController@handleGetMachineHistory');

});
