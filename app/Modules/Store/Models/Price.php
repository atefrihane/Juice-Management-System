<?php

namespace App\Modules\Store\Models;


use Illuminate\Database\Eloquent\Model;
use App\Modules\Store\Models\Store;
use App\Modules\Product\Models\Product;
class Price extends Model
{
    protected $fillable = ['price','product_id'];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_prices');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
