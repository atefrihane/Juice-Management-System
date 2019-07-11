<?php

Route::group(['module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function() {

    Route::resource('Admin', 'AdminController');

    route::get('/admin', "AdminController@index")->name('admin');
    route::get('/admin/add', "AdminController@create")->name('addAdmin');
    route::get('/admin/edit/{id}', "AdminController@edit")->name('editAdmin');
    route::post('/admin/update/{id}', "AdminController@update")->name('updateAdmin');
    route::post('/admin/store', "AdminController@store")->name('adminStore');
    route::get('/admin/delete/{id}',"AdminController@destroy")->name('deleteAdmin');
});
