<?php

namespace App\Modules\Store\Models;

use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;

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

}
