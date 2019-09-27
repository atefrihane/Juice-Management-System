<?php

namespace App\Modules\MachineRental\Models;

use App\Modules\Machine\Models\Machine;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Store;
use App\Modules\Bac\Models\Bac;
use Illuminate\Database\Eloquent\Model;

class MachineRental extends Model {

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
        'active'
        ];

   public function machine(){
       return $this->belongsTo(Machine::class);
   }

   public function store(){
       return $this->belongsTo(Store::class);
   }

   public function bacs(){
    return $this->HasMany(Bac::class,'rental_id','id');
}



}
