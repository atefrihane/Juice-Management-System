<?php

namespace App\Modules\Product\Models;

use App\Modules\Product\Models\ProductPrepare;
use Illuminate\Database\Eloquent\Model;

class ProductPrepare extends Model
{

    public function orderprouct()
    {
        return $this->belongsTo('App\Modules\Order\Models\OrderProduct', 'order_product_id');
    }

    public function productwarehouse()
    {
        return $this->belongsTo('App\Modules\Product\Models\ProductWarehouse', 'product_warehouse_id');
    }


}
