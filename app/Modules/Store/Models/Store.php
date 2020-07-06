<?php

namespace App\Modules\Store\Models;

use App\Modules\Company\Models\Company;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Order\Models\Order;
use App\Modules\Product\Models\Product;
use App\Modules\Store\Models\Price;
use App\Modules\Store\Models\StoreHistory;
use App\Modules\Store\Models\StoreSchedule;
use App\Modules\User\Models\Director;
use App\Modules\User\Models\Responsible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    public $with = ['city.country','zipcode'];

    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function director()
    {
        return $this->belongsTo(Director::class, 'director_id');
    }
    public function responsibles()
    {
        return $this->belongsToMany(Responsible::class, 'responsible_stores')->withTimestamps();
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function rentals()
    {
        return $this->hasMany(MachineRental::class);
    }
 
    public function machines()
    {
        $machines = [];
        foreach ($this->rentals as $rental) {
            if ($rental->active) {
                $machine = $rental->machine;
                $machine['bacs'] = $machine->bacs;
                foreach ($machine['bacs'] as $bac) {
                    $bac['product'] = $bac->product;
                }
                $machines[] = $machine;
            }

        }
        return $machines;
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function schedules()
    {
        return $this->hasMany(StoreSchedule::class);
    }
    public function zipcode()
    {
        return $this->belongsTo(Zipcode::class, 'zipcode_id');
    }
    public function histories()
    {
        return $this->hasMany(StoreHistory::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_products')->withPivot('quantity','packing','stock_display','packing_display');
    }

    public function prices()
    {
        return $this->belongsToMany(Price::class, 'store_prices');

    }
    public function orders()
    {
        return $this->hasMany(Order::class);

    }

}
