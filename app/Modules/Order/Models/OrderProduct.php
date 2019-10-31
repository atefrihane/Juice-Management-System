<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = ['id'];
    protected $table = "order_product";

    public function product()
    {
        return $this->belongsTo('App\Modules\Product\Models\Product', 'product_id');
    }

    public function order()
    {

        return $this->belongsTo('App\Modules\Order\Models\Order', 'order_id');

    }
}
