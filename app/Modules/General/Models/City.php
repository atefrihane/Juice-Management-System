<?php

namespace App\Modules\General\Models;

use App\Modules\General\Models\Country;
use App\Modules\General\Models\Company;
use App\Modules\General\Models\Zipcode;

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
    public function company()
    {
        return $this->hasOne(Company::class);

    }

}
