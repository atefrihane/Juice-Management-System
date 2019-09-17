<?php

Route::group(['module' => 'Product', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Product\Controllers'], function() {

    Route::get('products', 'ProductController@showProducts')->name('showProducts');
    Route::get('product/add', 'ProductController@showAddProduct')->name('showAddProduct');
    Route::get('products/custom/{id}', 'ProductController@showCustomProducts')->name('showCustomProducts');
    Route::get('product/custom/add/{id}', 'ProductController@showAddCustomProduct')->name('showAddCustomProduct');
    Route::get('product/edit/{id}', 'ProductController@edit')->name('editProduct');
    Route::get('product/delete/{id}', 'ProductController@delete')->name('deleteProduct');
    Route::post('product/update/{id}', 'ProductController@update')->name('updateProduct');
    Route::post('product/status/{id}', 'ProductController@handleUpdateStatus')->name('handleUpdateStatus');
});
