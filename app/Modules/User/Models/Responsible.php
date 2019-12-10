<?php

namespace App\Modules\User\Models;

use App\Modules\Store\Models\Store;
use App\Modules\User\Models\User;

class Responsible extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function user()
    {
        return $this->morphOne(User::class, 'child');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'responsible_stores');
    }

}
