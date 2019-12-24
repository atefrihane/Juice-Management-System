<?php

namespace App\Modules\Product\Models;

use App\Modules\Product\Models\ProductPrepare;
use App\Modules\Product\Models\ProductWarehouse;
use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderPrepare;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{

    protected $guarded = ['id','productCode','productBarcode','productPacking','url'];
    protected $table = "product_warehouse";

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_prepare')->withPivot('id','order_id', 'product_warehouse_id','quantity');
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
