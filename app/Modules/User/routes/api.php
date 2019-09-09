<?php

Route::group(['module' => 'User', 'middleware' => ['api'], 'namespace' => 'App\Modules\User\Controllers\api'], function() {


    route::get('users/all', "UserController@getUsers");

    route::post('api/login', 'UserController@login');
});
