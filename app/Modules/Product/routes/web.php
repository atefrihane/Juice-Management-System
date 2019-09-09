<?php

Route::group(['module' => 'Product', 'middleware' => ['web'], 'namespace' => 'App\Modules\Product\Controllers'], function() {

    Route::get('products', 'ProductController@showProducts')->name('showProducts');
    Route::get('product/add', 'ProductController@showAddProduct')->name('showAddProduct');
    Route::get('products/custom/{id}', 'ProductController@showCustomProducts')->name('showCustomProducts');
    Route::get('product/custom/add/{id}', 'ProductController@showAddCustomProduct')->name('showAddCustomProduct');
    Route::get('product/edit/{id}', 'ProductController@edit')->name('editProduct');

});
