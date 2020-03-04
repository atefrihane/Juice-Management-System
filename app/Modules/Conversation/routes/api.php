<?php

Route::group(['module' => 'Conversation', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Conversation\Controllers\api'], function() {

 Route::post('/conversation/{id}/seen','ConversationController@handleConversationVisibility');
 Route::post('/api/conversation/{id}/add','ConversationController@handleAddConversationMessage');
 Route::get('/api/conversations/user/{user_id}','ConversationController@handleShowConversationsByUser');
 Route::post('/api/conversations/{id}/user/{user_id}','ConversationController@handleAddConversationMessageClient');
 Route::post('/api/conversations/{id}/delete','ConversationController@handleDeleteConversation');
 Route::get('/api/conversations/{id}','ConversationController@handleShowConversation');
});
