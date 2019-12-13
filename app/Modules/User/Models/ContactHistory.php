<?php

namespace App\Modules\User\Models;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class ContactHistory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contact()
    {
        return $this->belongsTo(User::class, 'contact_id');
    }

}
