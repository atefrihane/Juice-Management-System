<?php

namespace App\Modules\Product\Models;

use App\Modules\Mixture\Models\Mixture;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function mixtures()
    {
        return $this->hasMany(Mixture::class);
    }

    public function productPrices()
    {
        return $this->hasMany('\App\Modules\CompanyPrice\Models\CompanyPrice');

    }
}
