<?php


Route::group(['module' => 'Company', 'middleware' => ['web', 'isAuth', 'primary.admin'], 'namespace' => 'App\Modules\Product\Controllers'], function () {

    Route::get('product/add', 'ProductController@showAddProduct')->name('showAddProduct');
    Route::get('products/update/custom/{id}/price/{price_id}', 'ProductController@showUpdateCustomProducts')->name('showUpdateCustomProducts');
    Route::get('product/edit/{id}', 'ProductController@edit')->name('editProduct');
});

Route::group(['module' => 'Product', 'middleware' => ['web','isAuth'], 'namespace' => 'App\Modules\Product\Controllers'], function() {

    Route::get('products', 'ProductController@showProducts')->name('showProducts');
    Route::get('products/custom/{id}', 'ProductController@showCustomProducts')->name('showCustomProducts');
    Route::post('products/price/update/{id}/{company_id}', 'ProductController@handleUpdateCustomProduct')->name('handleUpdateCustomProduct');
    Route::post('products//price/delete/{id}', 'ProductController@handleDeleteCustomProduct')->name('handleDeleteCustomProduct');
    Route::get('product/custom/add/{id}', 'ProductController@showAddCustomProduct')->name('showAddCustomProduct');
    Route::post('product/delete/{id}', 'ProductController@delete')->name('deleteProduct');
    Route::post('product/update/{id}', 'ProductController@update')->name('updateProduct');
    Route::post('product/status/{id}', 'ProductController@handleUpdateStatus')->name('handleUpdateStatus');
    route::post('/product/custom/{id}', 'ProductController@handleStoreCustomPrice')->name('handleStoreCustomPrice');
    Route::get('product/{id}', 'ProductController@showProduct')->name('showProduct');
});
