<?php

namespace App\Modules\Product\Models;

use App\Modules\Mixture\Models\Mixture;
use App\Modules\Order\Models\Order;
use App\Modules\Store\Models\Price;
use App\Modules\Store\Models\Store;
use App\Modules\Warehouse\Models\Warehouse;
use App\Modules\Product\Models\ProductHistory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['code', 'status', 'type', 'nom', 'designation', 'barcode', 'version', 'composition', 'color', 'weight', 'height', 'width', 'depth', 'public_price', 'period_of_validity', 'validity_after_opening', 'comment', 'photo_url', 'unit_by_display', 'unit_per_package', 'packing', 'tva'];

    public function mixtures()
    {
        return $this->hasMany(Mixture::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);

    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('product_id', 'order_id');

    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class)->withPivot('id', 'warehouse_id', 'product_id', 'packing', 'quantity', 'comment', 'creation_date', 'expiration_date','stock_display','packing_display');

    }
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_products');

    }

    public function bacs()
    {
        return $this->hasMany('\App\Modules\Bac\Models\Bac');

    }

    public function histories()
    {
        return $this->hasMany(ProductHistory::class);

    }

}
