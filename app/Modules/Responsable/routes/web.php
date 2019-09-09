<?php

Route::group(['module' => 'Responsable', 'middleware' => ['web'], 'namespace' => 'App\Modules\Responsable\Controllers'], function() {

    Route::resource('Responsable', 'ResponsableController');

});
