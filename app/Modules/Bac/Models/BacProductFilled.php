<?php

namespace App\Modules\Bac\Models;

use App\Modules\Store\Models\StoreProduct;
use Illuminate\Database\Eloquent\Model;

class BacProductFilled extends Model
{
    protected $table = 'bac_products_filled';
    protected $guarded = ['id'];

    public function productInStock()
    {
        return $this->belongsTo(StoreProduct::class, 'store_products_id');
    }

    public function productInBac()
    {
        return $this->belongsTo(BacProduct::class, 'bac_products_id');
    }

}
