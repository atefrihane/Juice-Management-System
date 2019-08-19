<?php

namespace App\Modules\CompanyPrice\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPrice extends Model {


    public function company(){

        return $this->belongsTo(Company::class);

    }
    public function product(){

        return $this->belongsTo(Product::class);

    }


}
