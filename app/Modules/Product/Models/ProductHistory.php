<?php

namespace App\Modules\Product\Models;

use App\Modules\Product\Models\Product;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');

    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

}
