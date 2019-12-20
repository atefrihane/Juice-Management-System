<?php

namespace App\Modules\Warehouse\Models;
use Illuminate\Database\Eloquent\Model;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\User\Models\User;
class Warehouse extends Model
{

    protected $fillable = ['code', 'designation', 'city_id','country_id', 'zipcode_id','user_id', 'surface', 'address', 'complement_address', 'comment', 'photo'];

    public function products()
    {
        return $this->belongsToMany('App\Modules\Product\Models\Product')
        ->withPivot( 'id','product_id', 'warehouse_id','packing','quantity','comment','creation_date','expiration_date','stock_display','packing_display');

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
