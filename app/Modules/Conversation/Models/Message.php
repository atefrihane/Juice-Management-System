<?php

namespace App\Modules\Conversation\Models;

use App\Modules\Conversation\Models\Conversation;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $appends = ['userCompany'];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');

    }

    public function getuserCompanyAttribute()
    {
       
        switch ($this->user->getType()) {

            case 'Autre':return $this->user->child->stores->first()->company;
                break;
            case 'Directeur':return $this->user->child->store->company;
            case 'admin':return 'admin';
                break;

        }
    }

}
