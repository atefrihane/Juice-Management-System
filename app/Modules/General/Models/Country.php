<?php

namespace App\Modules\General\Models;

use App\Modules\Company\Models\Company;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Zipcode;
use App\Modules\Store\Models\Store;
use App\Modules\Warehouse\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = ['name', 'code'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    public function Warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function zipcodes()
    {
        return $this->hasManyThrough(Zipcode::class, City::class);
    }

}
