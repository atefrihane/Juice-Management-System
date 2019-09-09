<?php

Route::group(['module' => 'Role', 'middleware' => ['web'], 'namespace' => 'App\Modules\Role\Controllers'], function() {

    Route::resource('Role', 'RoleController');

});
