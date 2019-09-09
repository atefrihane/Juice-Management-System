<?php

namespace App\Modules\Admin\Models;

use App\Modules\Role\Models\Role;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model {

    //
    protected $fillable = ['role_id'];

    public function user(){

        return $this->morphOne(User::class,'child');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }


}
