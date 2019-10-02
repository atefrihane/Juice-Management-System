<?php

namespace App\Modules\General\Models;

use App\Modules\General\Models\City;
use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{

    protected $fillable = ['code', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');

    }

}
