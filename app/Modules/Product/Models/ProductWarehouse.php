<?php

namespace App\Modules\Product\Models;

use App\Modules\Product\Models\ProductPrepare;
use App\Modules\Product\Models\ProductWarehouse;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{

    protected $fillable = ['packing', 'quantity', 'creation_date', 'expiration_date', 'comment', 'product_id', 'warehouse_id'];
    protected $table = "product_warehouse";

    public function prepared()
    {
        return $this->hasMany(ProductPrepare::class);

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
