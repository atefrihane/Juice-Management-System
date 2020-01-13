<?php

Route::group(['module' => 'User', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\User\Controllers\api'], function() {


    // route::get('users/all', "UserController@getUsers");
    route::get('/api/users/show', "UserController@showUsers");
    route::get('/api/preparators/show', "UserController@showPreparators");
    route::get('/api/deliveries/show', "UserController@showDeliveries");
  
    Route::post('/api/contact/save/{id}', 'UserController@storeClient')->name('storeClient');
    Route::post('/api/contact/update/{cid}/{id}', 'UserController@updateClient')->name('updateClient');
});

Route::group(['module' => 'User', 'middleware' => ['web'], 'namespace' => 'App\Modules\User\Controllers\api'], function() {


    route::get('api/login', 'UserController@login');
});

