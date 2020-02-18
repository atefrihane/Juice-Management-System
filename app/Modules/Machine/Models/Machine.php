<?php

namespace App\Modules\Machine\Models;

use App\Modules\Bac\Models\Bac;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use SoftDeletes;

    //
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function machineRentals()
    {
        return $this->hasMany(MachineRental::class);
    }
    public function bacs()
    {
        return $this->hasMany(Bac::class);
    }

    public function histories()
    {
        return $this->hasMany(MachineHistory::class);
    }
    public function currentLocation()
    {
        return MachineRental::where('machine_id', $this->id)
            ->where('active', 1)
            ->first();

    }
}
