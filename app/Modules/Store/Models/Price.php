<?php

namespace App\Modules\Store\Models;

use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;
    protected $fillable = ['price', 'product_id'];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_prices');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
