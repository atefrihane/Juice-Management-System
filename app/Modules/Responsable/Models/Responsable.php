<?php

namespace App\Modules\Responsable\Models;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model {

    //
    public function user(){
        return $this->morphOne(User::class,'child');
    }

}
