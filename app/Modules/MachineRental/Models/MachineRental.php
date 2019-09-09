<?php

namespace App\Modules\MachineRental\Models;

use App\Modules\Machine\Models\Machine;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;

class MachineRental extends Model {

    //
   protected $guarded = ['id', 'updated_at', 'created_at'];

   public function machine(){
       return $this->belongsTo(Machine::class);
   }

   public function store(){
       return$this->belongsTo(Store::class);
   }



}
