<?php

namespace App\Modules\General\Models;

use App\Modules\Company\Models\Company;
use App\Modules\General\Models\City;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{

    protected $fillable = ['code', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');

    }

    public function stores()
    {
        return $this->hasMany(Store::class);

    }
    public function companies()
    {
        return $this->hasMany(Company::class);

    }

}
