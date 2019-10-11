<?php

namespace App\Modules\CompanyPrice\Models;
use App\Modules\Company\Models\Company;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;

class CompanyPrice extends Model
{
    protected $fillable = [
        'product_id',
        'company_id',
        'store_id',
        'price'
       
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');

    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');

    }

    public function product()
    {
        return $this->belongsTo('\App\Modules\Product\Models\Product', 'product_id');

    }

}
