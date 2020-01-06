<?php

Route::group(['module' => 'Conversation', 'middleware' => ['api'], 'namespace' => 'App\Modules\Conversation\Controllers'], function() {

    Route::resource('Conversation', 'ConversationController');

});
