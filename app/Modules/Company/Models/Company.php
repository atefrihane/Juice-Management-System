<?php

namespace App\Modules\Company\Models;

use App\Modules\Company\Models\CompanyHistory;
use App\Modules\General\Models\City;
use App\Modules\General\Models\Country;
use App\Modules\General\Models\Zipcode;
use App\Modules\MachineRental\Models\MachineRental;
use App\Modules\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = ['code', 'status', 'name', 'country_id', 'email', 'tel', 'designation', 'city_id', 'zipcode_id', 'address', 'complement', 'comment', 'logo'];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function getStatus()
    {
        $status = '';
        switch ($this->status) {
            case 0:$status = 'Fermé';
                break;
            case 1:$status = ' En sommeil';
                break;
            case 2:$status = 'Active';
                break;
        }
        return $status;
    }
    public function getNbrStores()
    {
        return sizeof($this->stores);
    }
    public function rentedMachines()
    {
        $rentedMachines = [];

        foreach ($this->stores as $store) {
            foreach (MachineRental::where('store_id', $store->id)->where('active', true)->get() as $machine) {
                $rentedMachines[] = $machine;

            }
        }
        return $rentedMachines;
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
    public function histories()
    {
        return $this->hasMany(CompanyHistory::class);

    }

    public function contacts($user)
    {
        $directors = $this->stores()->whereHas('director', function ($q) use ($user) {
            $q->where('director_id', $user->child_id);
        })->get();

        $responsibles = $this->stores()->whereHas('responsibles', function ($q) use ($user) {
            $q->where('responsible_id', $user->child_id);
        })->get();
        $contacts = $directors->toBase()->merge($responsibles);
        if (count($contacts) > 0) {
            return true;
        }
        return false;
    }
}
