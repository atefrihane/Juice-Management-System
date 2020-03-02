<?php

namespace App\Modules\MachineRental\Models;

use App\Modules\BacHistory\Models\BacHistory;
use App\Modules\MachineRental\Models\MachineRentalHistory;
use App\Modules\Machine\Models\Machine;
use App\Modules\Store\Models\Store;
use DB;
use Illuminate\Database\Eloquent\Model;

class MachineRental extends Model
{
    protected $appends = ['latestExpiration'];

    //
    protected $fillable = [
        'date_debut',
        'date_fin',
        'store_id',
        'machine_id',
        'location',
        'Comment',
        'end_reason',
        'price',
        'active',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function getlatestExpirationAttribute()
    {

        return DB::table('bac_products')
            ->join('bacs', 'bacs.id', '=', 'bac_products.bac_id')
            ->join('machines', 'machines.id', '=', 'bacs.machine_id')
            ->whereIn('bac_id', $this->machine->bacs()->pluck('id'))
            ->orderByRaw('expiration_date ASC')
            ->select(DB::raw('bac_id,expiration_date,machines.id as machine_id'))
            ->first();

    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function bacHistories()
    {
        return $this->HasMany(BacHistory::class);
    }

    public function histories()
    {
        return $this->hasMany(MachineRentalHistory::class);
    }

}
