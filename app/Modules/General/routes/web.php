<?php

Route::group(['module' => 'General', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\General\Controllers'], function() {

Route::get('/','GeneralController@showHome')->name('showHome');
});



