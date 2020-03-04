<?php

namespace App\Modules\Store\Models;

use App\Modules\User\Models\User;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Store\Models\StoreProduct;
use App\Modules\Store\Models\StoreProductHistoryDetails;

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
        return $this->hasMany(StoreProductHistoryDetails::class,'store_products_history_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
