<?php

namespace App\Modules\Order\Models;

use App\Modules\Product\Models\ProductPrepare;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Store;
use App\Modules\Order\Models\OrderHistory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('order_id', 'product_id');

    }
    public function prepared()
    {
        return $this->hasMany(ProductPrepare::class);

    }
    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }
    public function histories()
    {
        return $this->hasMany(OrderHistory::class);
    }
}
