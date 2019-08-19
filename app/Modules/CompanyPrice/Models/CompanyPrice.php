<?php

namespace App\Modules\CompanyPrice\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Company\Models\Company;
use App\Modules\Product\Models\Product;


class CompanyPrice extends Model {


    public function company(){

        return $this->belongsTo(Company::class);

    }

    public function product(){

        return $this->belongsTo(Product::class);

    }


}
