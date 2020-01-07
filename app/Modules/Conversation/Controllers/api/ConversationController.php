<?php

namespace App\Modules\Conversation\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Conversation\Models\Conversation;
use App\Modules\Admin\Models\Admin;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function handleConversationVisibility(Request $request , $id)
    {

        $conversation = Conversation::find($id);
        if ($conversation) {
            $conversation->messages->last()->update(['seen' => $request->value]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);
    }

    public function handleAddConversationMessage(Request $request,$id)
    {
    
        $conversation = Conversation::find($id);
        if ($conversation) {
            $conversation->messages()->create([
                'message' =>$request->message,
                'user_id'=>Admin::first()->user->id,
                'seen' => 1,
                'conversation_id' => $id
            ]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);

    }

}
