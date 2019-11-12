<?php

namespace App\Modules\Order\Models;

use App\Modules\Order\Models\Order;
use App\Modules\Product\Models\ProductWarehouse;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderPrepare extends Pivot
{
    protected $guarded = ['id'];
    protected $table = 'order_prepare';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function productwarehouse()
    {
        return $this->belongsToMany(ProductWarehouse::class, 'product_warehouse_id');
    }

}
