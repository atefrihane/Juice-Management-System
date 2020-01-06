<?php

namespace App\Modules\Conversation\Models;

use App\Modules\Conversation\Models\Message;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_users');

    }

    public function messages()
    {
        return $this->hasMany(Message::class);

    }

}
