<?php

namespace App\Modules\SuperVisor\Models;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class SuperVisor extends Model {

    //

    public function user(){
        return $this->morphOne(User::class,'child');
    }
}
