<?php

Route::group(['module' => 'User', 'middleware' => ['web','isGuest'], 'namespace' => 'App\Modules\User\Controllers'], function() {

 Route::post('/login','UserController@handleLogin')->name('handleLogin');
 Route::get('/login','UserController@showLogin')->name('showLogin');
});
Route::group(['module' => 'User', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\User\Controllers'], function() {

    Route::get('/logout','UserController@handleSignOut')->name('handleSignOut');

    Route::post('contact/save/{id}', 'UserController@storeClient')->name('storeClient');

    Route::get('contact/edit/{cid}/{id}', 'UserController@edit')->name('editClient');

    Route::post('contact/update/{cid}/{id}', 'UserController@updateClient')->name('updateClient');
    route::post('contact/delete/{cid}/{id}', 'UserController@deleteClient')->name('deleteContact');
    route::get('contact/{cid}/{id}', 'UserController@detailClient')->name('detailClient');


   });

