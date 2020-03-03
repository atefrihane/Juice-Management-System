<?php

namespace App\Modules\Store\Models;

use App\Modules\Store\Models\Store;
use App\Modules\Store\Models\StoreProduct;
use App\Modules\Store\Models\StoreProductHistoryDetails;
use Illuminate\Database\Eloquent\Model;

class StoreProductHistory extends Model
{

    protected $guarded = ['id'];
    protected $table = 'store_products_history';
    public function storeProduct()
    {
        return $this->belongsTo(StoreProduct::class, 'store_products_id');
    }

    public function histories()
    {
        return $this->hasMany(StoreProductHistoryDetails::class);
    }

}
