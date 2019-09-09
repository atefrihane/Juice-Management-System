<?php

namespace App\Modules\CompanyPrice\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPrice extends Model
{
    protected $fillable = [
        'product_id',
        'company_id',
        'price'
       
    ];

    public function company()
    {
        return $this->belongsTo(' App\Modules\Company\Models\Company', 'company_id');

    }

    public function product()
    {
        return $this->belongsTo(' App\Modules\Product\Models\Product', 'product_id');

    }

}
