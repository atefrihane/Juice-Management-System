<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity'];
    protected $table = "order_product";

    public function productwarehouses()
    {
        return $this->belongsToMany('App\Modules\Product\Models\ProductWarehouse', 'product_prepare');

    }

    public function product()
    {
        return $this->belongsTo('App\Modules\Product\Models\Product', 'product_id');
    }

    public function order()
    {

        return $this->belongsTo('App\Modules\Order\Models\Order', 'order_id');

    }
}
