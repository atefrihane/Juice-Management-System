<?php

namespace App\Modules\General\Models;

use App\Modules\Company\Models\Company;
use App\Modules\Store\Models\Store;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\Warehouse\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function zipcodes()
    {
        return $this->hasMany(Zipcode::class);
    }
    public function companies()
    {
        return $this->hasMany(Company::class);

    }

    public function stores()
    {
        return $this->hasMany(Store::class);

    }
    public function Warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

}
