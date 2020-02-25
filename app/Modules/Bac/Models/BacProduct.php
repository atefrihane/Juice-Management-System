<?php

namespace App\Modules\Bac\Models;

use App\Modules\Bac\Models\Bac;
use App\Modules\Bac\Models\BacProductFilled;
use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class BacProduct extends Model
{
    protected $table = 'bac_products';
    protected $guarded = ['id'];

    public function productsInStock()
    {
        return $this->hasMany(BacProductFilled::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function bac()
    {
        return $this->belongsTo(Bac::class, 'bac_id');
    }

}
