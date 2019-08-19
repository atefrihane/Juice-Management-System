<?php

namespace App\Modules\Machine\Models;

use App\Modules\Bac\Models\Bac;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model {

    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function bacs(){
        return $this->hasMany(Bac::class);
    }
}
