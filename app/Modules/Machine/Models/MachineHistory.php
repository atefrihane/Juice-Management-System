<?php

namespace App\Modules\Machine\Models;

use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class MachineHistory extends Model
{
    protected $fillable = ['event', 'comment', 'machine_id','user_id'];
 
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
