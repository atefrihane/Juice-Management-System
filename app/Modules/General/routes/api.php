<?php

Route::group(['module' => 'General', 'middleware' => ['api'], 'namespace' => 'App\Modules\General\Controllers\api'], function() {
Route::post('/country/add','GeneralController@handleAddCountryData');
   

});
