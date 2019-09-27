<?php

namespace App\Modules\BacHistory\Models;

use Illuminate\Database\Eloquent\Model;

class BacHistory extends Model
{

    protected $fillable=['action','bac_id','user_id'];

    public function bac()
    {
        return $this->belongsTo('App\Modules\Bac\Models\Bac', 'bac_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Modules\User\Models\User', 'user_id');
    }

    public function rental()
    {
        return $this->belongsTo('App\Modules\MachineRental\Models\MachineRental', 'machine_rental_id');
    }

}
