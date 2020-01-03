<?php

Route::group(['module' => 'User', 'middleware' => ['api'], 'namespace' => 'App\Modules\User\Controllers\api'], function() {


    // route::get('users/all', "UserController@getUsers");
    route::get('/users/show', "UserController@showUsers");
    route::get('/api/preparators/show', "UserController@showPreparators");
    route::get('/api/deliveries/show', "UserController@showDeliveries");
    route::post('api/login', 'UserController@login');
    Route::post('/api/contact/save/{id}', 'UserController@storeClient')->name('storeClient');
    Route::post('/api/contact/update/{cid}/{id}', 'UserController@updateClient')->name('updateClient');
});
