<?php

Route::group(['module' => 'Conversation', 'middleware' => ['auth:api'], 'namespace' => 'App\Modules\Conversation\Controllers\api'], function() {

 Route::post('/conversation/{id}/seen','ConversationController@handleConversationVisibility');
 Route::post('/api/conversation/{id}/add','ConversationController@handleAddConversationMessage');
});
