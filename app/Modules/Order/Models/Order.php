<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['code', 'date', 'status', 'store_id', 'user_id', 'parent_id'];

    public function products()
    {
        return $this->belongsToMany('App\Modules\Product\Models\Product', 'order_product');

    }

}
