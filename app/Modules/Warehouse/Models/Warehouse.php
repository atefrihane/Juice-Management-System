<?php

namespace App\Modules\Warehouse\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{

    protected $fillable = ['code', 'designation', 'city', 'postal_code', 'surface', 'address', 'complement_address', 'comment', 'photo'];

    public function products()
    {
        return $this->belongsToMany('App\Modules\Product\Models\Product', 'product_warehouse');

    }

}
