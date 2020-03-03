<?php

namespace App\Modules\Store\Models;

use App\Modules\Store\Models\Store;
use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Store\Models\StoreProductHistory;


class StoreProduct extends Model
{
  
    protected $guarded = ['id'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function histories()
    {
        return $this->hasMany(StoreProductHistory::class);
    }

}
