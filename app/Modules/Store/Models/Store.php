<?php

namespace App\Modules\Store\Models;

use App\Modules\CompanyPrice\Models\CompanyPrice;
use App\Modules\Company\Models\Company;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Machine\Models\Machine;
use App\Modules\Product\Models\Product;
use App\Modules\Responsable\Models\Responsable;
use App\Modules\Store\Models\StoreHistory;
use App\Modules\Store\Models\StoreSchedule;
use App\Modules\SuperVisor\Models\SuperVisor;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function responsables()
    {
        return $this->hasMany(Responsable::class)->with('user');
    }
    public function supervisor()
    {
        return $this->belongsTo(SuperVisor::class, 'super_visor_id');
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
        return $this->belongsToMany(Product::class, 'store_products');

    }

    public function companyPrices()
    {
        return $this->hasMany(CompanyPrice::class);

    }

}
