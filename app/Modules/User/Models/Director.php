<?php

namespace App\Modules\User\Models;
use App\Modules\User\Models\User;
use App\Modules\Store\Models\Store;

class Director extends Model
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

    public function store()
    {
        return $this->hasOne(Store::class);
    }
 


}
