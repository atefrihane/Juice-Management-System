<?php

Route::group(['module' => 'Contact', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Contact\Controllers'], function() {

    Route::get('contacts/{id}', 'ContactController@showContacts')->name('showContacts');
    Route::get('contact/add/{id}', 'ContactController@showAddContact')->name('showAddContact');
});
