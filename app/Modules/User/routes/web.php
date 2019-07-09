<?php

Route::group(['module' => 'User', 'middleware' => ['web','isGuest'], 'namespace' => 'App\Modules\User\Controllers'], function() {

 Route::post('/login','UserController@handleLogin')->name('handleLogin');
 Route::get('/login','UserController@showLogin')->name('showLogin');
});
Route::group(['module' => 'User', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\User\Controllers'], function() {

    Route::get('/logout','UserController@handleSignOut')->name('handleSignOut');

   });

