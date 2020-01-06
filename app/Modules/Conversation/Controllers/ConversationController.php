<?php

namespace App\Modules\Conversation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Conversation\Models\Conversation;
use Illuminate\Http\Request;
use Auth;

class ConversationController extends Controller
{

    public function showConversations()
    {
        return view('Conversation::showConversations',['conversations' => Conversation::paginate(5) ,'count' =>Conversation::count()]);
    }

    public function showAddConversation()
    {
        return view('Conversation::showAddConversation', ['companies' => Company::all()]);
    }
    public function handleAddConversation(Request $request)
    {
        $conversation = Conversation::create([
            'subject' => $request->subject,
        ]);
        $conversation->messages()->create([
            'message' => $request->message,
            'user_id' => Auth::id(),
        ]);
        $ids = [Auth::id(), $request->user_id];
        $conversation->users()->attach($ids);
        alert()->success('Message envoyé avec succés!','Succés!')->persistent('Fermer');
        return redirect()->route('showConversations');

    }
}
