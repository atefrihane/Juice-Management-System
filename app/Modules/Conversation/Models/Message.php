<?php

namespace App\Modules\Conversation\Models;

use App\Modules\Conversation\Models\Conversation;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function conversation_id()
    {
        return $this->hasMany(Conversation::class, 'conversation_id');

    }

}
