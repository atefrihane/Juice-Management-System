<?php

namespace App\Modules\CompanyPrice\Models;
use App\Modules\Company\Models\Company;
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
        return $this->belongsTo(Company::class, 'company_id');

    }

    public function product()
    {
        return $this->belongsTo('\App\Modules\Product\Models\Product', 'product_id');

    }

}
