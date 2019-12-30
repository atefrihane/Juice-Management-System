<?php

Route::group(['module' => 'User', 'middleware' => ['web','isGuest'], 'namespace' => 'App\Modules\User\Controllers'], function() {

 Route::post('/login','UserController@handleLogin')->name('handleLogin');
 Route::get('/login','UserController@showLogin')->name('showLogin');
});

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth','primary.admin'], 'namespace' => 'App\Modules\User\Controllers'], function () {

    Route::get('contact/show//add/{id}', 'UserController@showAddContact')->name('showAddContact');
});

Route::group(['module' => 'User', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\User\Controllers'], function() {

    Route::get('/logout','UserController@handleSignOut')->name('handleSignOut');

    Route::get('contact/edit/{cid}/{id}', 'UserController@edit')->name('editClient');
   
    route::post('contact/delete/{cid}/{id}', 'UserController@deleteClient')->name('deleteContact');
    route::get('contact/{cid}/{id}', 'UserController@showContact')->name('showContact');
    Route::get('contacts/{id}', 'UserController@showContacts')->name('showContacts');
   


   });

