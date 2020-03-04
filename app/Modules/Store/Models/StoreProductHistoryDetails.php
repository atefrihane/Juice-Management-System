<?php

namespace App\Modules\Store\Models;

use App\Modules\Store\Models\StoreProductHistory;
use Illuminate\Database\Eloquent\Model;

class StoreProductHistoryDetails extends Model
{

    protected $guarded = ['id'];
    protected $table = 'store_products_history_details';
    public function storeProductHistory()
    {
        return $this->belongsTo(StoreProductHistory::class);
    }

}
