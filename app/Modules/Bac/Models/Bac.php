<?php

namespace App\Modules\Bac\Models;

use App\Modules\Mixture\Models\Mixture;
use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Bac extends Model {

    //

    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function mixture(){
        return $this->belongsTo(Mixture::class);
    }
}
