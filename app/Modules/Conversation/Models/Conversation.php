<?php

namespace App\Modules\Conversation\Models;

use App\Modules\Conversation\Models\Message;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{

    use SoftDeletes;

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
