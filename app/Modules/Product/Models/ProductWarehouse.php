<?php

namespace App\Modules\Product\Models;

use App\Modules\Product\Models\ProductWarehouse;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{

    protected $fillable = ['packing', 'quantity', 'creation_date', 'expiration_date', 'comment', 'product_id', 'warehouse_id'];

    public function orderproducts()
    {
        return $this->belongsToMany('App\Modules\Order\Models\OrderProduct', 'product_prepare');

    }

    public function product()
    {
        return $this->belongsTo('App\Modules\Product\Models\Product', 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Modules\Warehouse\Models\Warehouse', 'warehouse_id');
    }

}
