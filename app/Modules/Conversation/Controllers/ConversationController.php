<?php

namespace App\Modules\Conversation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Admin;
use App\Modules\Company\Models\Company;
use App\Modules\Conversation\Models\Conversation;
use App\Modules\User\Models\Director;
use App\Modules\User\Models\Responsible;
use App\Modules\User\Models\User;
use Auth;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    public function showConversations()
    {
        $conversations = Conversation::has('messages')->orderBy('created_at', 'DESC')->with('messages.user')->paginate(5);

        if (count($conversations) > 0) {

            foreach ($conversations as $conversation) {
                if ($conversation->messages->last()->user->child_type == Admin::class) {
                    $conversation->setAttribute('is_admin', true);

                } else {
                    $conversation->setAttribute('is_admin', false);

                }

            }
        }

        return view('Conversation::showConversations', ['conversations' => $conversations, 'count' => Conversation::count()]);
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
        $conversation = Conversation::has('messages')->where('id', $id)->with('messages', 'messages.user.child')->first();

        if ($conversation) {

            $lastMessage = $conversation->messages()
                ->where('seen', 0)
                ->whereHas('user', function ($q) {
                    $q->where('child_type', '<>', Admin::class);
                })->update(['seen' => 1]);

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

    public function handleDeleteConversation($id)
    {
        $conversation = Conversation::find($id);
        if ($conversation) {
            if (!$conversation->messages()->exists()) {
                $conversation->delete();
                alert()->success('La conversation a été supprimée avec succés!', 'Succés!');
                return redirect()->back();
            }
            alert()->error('Cette entité ne peut pas être supprimée, autres entités y sont liées', 'Oups! ')->persistent("Fermer");
            return redirect()->back();

        }
        return view('General::notFound');
    }
}
