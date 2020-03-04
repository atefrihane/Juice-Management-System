<?php

namespace App\Modules\Conversation\Controllers\api;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Admin;
use App\Modules\Conversation\Models\Conversation;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function handleConversationVisibility(Request $request, $id)
    {

        $conversation = Conversation::find($id);
        if ($conversation) {
            $conversation->messages->last()->update(['seen' => $request->value]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);
    }

    public function handleAddConversationMessage(Request $request, $id)
    {

        $conversation = Conversation::find($id);
        if ($conversation) {
            $conversation->messages()->create([
                'message' => $request->message,
                'user_id' => Admin::first()->user->id,
                'seen' => 1,
                'conversation_id' => $id,
            ]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404]);

    }

    public function handleShowConversationsByUser($id)
    {
        $checkUser = User::find($id);
        if ($checkUser) {
            $conversations = Conversation::whereHas('users', function ($q) use ($id) {
                $q->where('conversation_users.user_id', $id);
            })
                ->with('messages.user')
                ->get();

            return response()->json(['status' => 200, 'conversations' => $conversations]);

        }

        return response()->json(['status' => 404]);
    }

    public function handleAddConversationMessageClient(Request $request, $id, $user_id)
    {
        if (!$request->filled('message')) {
            return response()->json(['status' => 400]);
        }
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => 404, 'User' => 'User not found']);

        }
        $conversation = Conversation::find($id);
        if ($conversation) {
            $conversation->messages()->create([
                'message' => $request->message,
                'user_id' => $user_id,
                'seen' => 0,
                'conversation_id' => $id,
            ]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 404, 'Conversation' => 'Conversation not found']);

    }
    public function handleDeleteConversation($id)
    {
        $checkConversation = Conversation::find($id);
        if ($checkConversation) {
            $checkConversation->delete();
            return response()->json(['status' => 200]);

        }
        return response()->json(['status' => 404, 'Conversation' => 'Conversation not found']);
    }

    public function handleShowConversation($id)
    {
        $conversation = Conversation::find($id);
        if ($conversation) {

            return response()->json([
                'status' => 200,
                'messages' => $conversation->messages()->with('user')->get()]);

        }
        return response()->json(['status' => 404, 'Conversation' => 'Conversation not found']);
    }

}
