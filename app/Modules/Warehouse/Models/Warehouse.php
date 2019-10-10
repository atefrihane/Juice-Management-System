<?php

namespace App\Modules\Warehouse\Models;
use Illuminate\Database\Eloquent\Model;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;

class Warehouse extends Model
{

    protected $fillable = ['code', 'designation', 'city_id','country_id', 'zipcode_id', 'surface', 'address', 'complement_address', 'comment', 'photo'];

    public function products()
    {
        return $this->belongsToMany('App\Modules\Product\Models\Product', 'product_warehouse');

    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function zipcode()
    {
        return $this->belongsTo(Zipcode::class, 'zipcode_id');
    }

}
