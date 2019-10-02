<?php

namespace App\Modules\General\Models;

use App\Modules\General\Models\Country;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
