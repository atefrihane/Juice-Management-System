<?php

Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'primary.admin'], 'namespace' => 'App\Modules\Admin\Controllers'], function () {

    route::get('/admin/add', "AdminController@create")->name('addAdmin');
    route::get('/admin', "AdminController@index")->name('admin');

    route::get('/admin/edit/{id}', "AdminController@edit")->name('editAdmin');
});

Route::group(['module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function () {

    Route::resource('Admin', 'AdminController');

   
    route::post('/admin/update/{id}', "AdminController@update")->name('updateAdmin');
    route::post('/admin/store', "AdminController@store")->name('adminStore');
    route::post('/admin/delete/{id}', "AdminController@destroy")->name('deleteAdmin');
});
