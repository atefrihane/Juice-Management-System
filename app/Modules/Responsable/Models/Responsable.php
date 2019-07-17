<?php

namespace App\Modules\Responsable\Models;

use App\Modules\Store\Models\Store;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model {

    //
    protected $fillable = ['store_id'];

    public function user(){
        return $this->morphOne(User::class,'child');
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }

}
