<?php

namespace App\Modules\Store\Models;

use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Price;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;

class StorePrice extends Model
{
    protected $fillable = ['store_id', 'price_id', 'product_id'];
    protected $table = 'store_prices';

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
