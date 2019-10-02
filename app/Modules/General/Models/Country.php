<?php

namespace App\Modules\General\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Zipcode;

class Country extends Model
{

    protected $fillable = ['name', 'code'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function zipcodes()
    {
        return $this->hasManyThrough(Zipcode::class, City::class);
    }

}
