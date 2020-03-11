<?php

namespace App\Modules\Machine\Models;

use App\Modules\Machine\Models\Machine;
use App\Modules\Machine\Models\MachineHistory;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class MachineHistory extends Model
{
    protected $fillable = ['event', 'comment', 'machine_id', 'active', 'user_id', 'rental_id'];
    public $with = ['machine', 'user'];

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
