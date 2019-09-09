<?php

Route::group(['module' => 'Responsable', 'middleware' => ['api'], 'namespace' => 'App\Modules\Responsable\Controllers'], function() {

    Route::resource('Responsable', 'ResponsableController');

});
