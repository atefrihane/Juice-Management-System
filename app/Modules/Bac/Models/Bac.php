<?php

namespace App\Modules\Bac\Models;

use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Bac extends Model
{

    protected $guarded = ['id'];
    
    public function products()
    {
        return $this->belongsToMany(Product::class,'bac_products')->withPivot('id');
    }


    public function machine()
    {
        return $this->belongsTo(Machine::class,'machine_id');
    }

   
}
