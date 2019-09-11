<?php

namespace App\Modules\Product\Models;

use App\Modules\Mixture\Models\Mixture;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['code', 'status', 'type', 'nom', 'designation', 'barcode', 'version', 'composition', 'color', 'weight', 'height', 'width', 'depth', 'public_price', 'period_of_validity', 'validity_after_opening', 'comment', 'photo_url', 'unit_by_display', 'unit_per_package', 'packing'];

    public function mixtures()
    {
        return $this->hasMany(Mixture::class);
    }

    public function productPrices()
    {
        return $this->hasMany('\App\Modules\CompanyPrice\Models\CompanyPrice');

    }
    public function orders()
    {
        return $this->belongsToMany('App\Modules\Order\Models\Order', 'order_product');

    }

    public function warehouses()
    {
        return $this->belongsToMany('App\Modules\Warehouse\Models\Warehouse', 'product_warehouse');

    }
}
