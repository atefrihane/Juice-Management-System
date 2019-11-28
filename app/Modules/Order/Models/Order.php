<?php

namespace App\Modules\Order\Models;

use App\Modules\Order\Models\Order;
use App\Modules\Order\Models\OrderHistory;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductWarehouse;
use App\Modules\Store\Models\Store;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('order_id', 'product_id');

    }
    public function productwarehouses()
    {
        return $this->belongsToMany(ProductWarehouse::class, 'order_prepare')->withPivot('product_warehouse_id', 'order_id', 'quantity');

    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function histories()
    {
        return $this->hasMany(OrderHistory::class);
    }
    public function preparator()
    {
        return $this->belongsTo(User::class, 'preparator_id');
    }
    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_man_id');
    }

    public function parent()
    {
        return $this->belongsTo(Order::class, 'parent_id');
    }

    public function getAmountAttribute($value)
{
    return money_format('$%i', $value);
}
}
