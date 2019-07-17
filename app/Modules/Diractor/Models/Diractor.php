<?php

namespace App\Modules\Diractor\Models;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Diractor extends Model {

    //
    protected $fillable = ['company_id'];

    public function user(){
        return $this->morphOne(User::class,'child');
    }

}
