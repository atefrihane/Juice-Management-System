<?php

namespace App\Modules\Conversation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Company\Models\Company;
use App\Modules\Conversation\Models\Conversation;
use App\Modules\User\Models\Responsible;
use Auth;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    public function showConversations()
    {
        return view('Conversation::showConversations', ['conversations' => Conversation::orderBy('created_at', 'DESC')->paginate(5), 'count' => Conversation::count()]);
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
            'seen' => 1,
        ]);
        $ids = [Auth::id(), $request->user_id];
        $conversation->users()->attach($ids);
        alert()->success('Message envoyé avec succés!', 'Succés!')->persistent('Fermer');
        return redirect()->route('showConversations');

    }

    public function showConversation($id)
    {
        $conversation = Conversation::where('id', $id)->with('messages', 'messages.user.child')->first();

        if ($conversation) {
            $conversation->messages->last()->update(['seen' => 1]);

            if (count($conversation->messages) > 0) {
                foreach ($conversation->messages as $message) {

                    if ($message->user->child instanceof Responsible) {
                        if (count($message->user->child->stores) > 0) {
                            $message->user->setAttribute('company_name', $message->user->child->stores->first()->company->name);
                        }

                    }

                    if ($message->user->child instanceof Director) {
                        if ($message->user->child->store) {
                            $message->user->setAttribute('company_name', $message->user->child->store->company->name);
                        }

                    }

                }
            }
           

            return view('Conversation::showConversation', compact('conversation'));

        }
        return view('General::notFound');
    }
}
