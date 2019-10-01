<?php

Route::group(['module' => 'Mixture', 'middleware' => ['api'], 'namespace' => 'App\Modules\Mixture\Controllers\api'], function() {

//    Route::resource('Mixture', 'MixtureController');
    route::post('api/mixtures', 'MixtureController@store');
    route::get('api/mixtures', 'MixtureController@handleGetMixtures');
});
