<?php

namespace App\Modules\Store\Models;

use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;

class StoreSchedule extends Model
{

    protected $fillable = ['day', 'start_day_time', 'end_day_time', 'start_night_time', 'end_night_time', 'closed', 'store_id'];
    protected $table = 'stores_schedules';
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

}
