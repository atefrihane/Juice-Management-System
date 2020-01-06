<?php

Route::group(['module' => 'Conversation', 'middleware' => ['web', 'isAuth'], 'namespace' => 'App\Modules\Conversation\Controllers'], function () {
    Route::get('/conversations', 'ConversationController@showConversations')->name('showConversations');
    Route::get('/conversation/add', 'ConversationController@showAddConversation')->name('showAddConversation');
    Route::post('/conversation/add', 'ConversationController@handleAddConversation')->name('handleAddConversation');
    Route::get('/conversation/{id}', 'ConversationController@showConversation')->name('showConversation');
});
