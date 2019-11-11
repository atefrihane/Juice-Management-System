<?php

namespace App\Modules\Product\Models;

use App\Modules\Order\Models\Order;
use App\Modules\Product\Models\ProductPrepare;
use App\Modules\Product\Models\ProductWarehouse;
use Illuminate\Database\Eloquent\Model;

class ProductPrepare extends Model
{
    protected $guarded=['id'];
    protected $table = 'product_prepare';
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function productwarehouse()
    {
        return $this->belongsTo(ProductWarehouse::class, 'product_warehouse_id');
    }

}
