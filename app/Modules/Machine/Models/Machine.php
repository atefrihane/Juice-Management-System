<?php

namespace App\Modules\Machine\Models;

use App\Modules\Bac\Models\Bac;
use App\Modules\MachineRental\Models\MachineRental;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model {

    //
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function machineRentals(){
        return $this->hasMany(MachineRental::class);
    }
    public function bacs(){
        return $this->hasMany(Bac::class);
    }
}
