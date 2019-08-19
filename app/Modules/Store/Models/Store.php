<?php

namespace App\Modules\Store\Models;

use App\Modules\Company\Models\Company;
use App\Modules\Responsable\Models\Responsable;
use App\Modules\SuperVisor\Models\SuperVisor;
use Illuminate\Database\Eloquent\Model;

class Store extends Model {

    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function responsables(){
        return $this->hasMany(Responsable::class)->with('user');
    }
    public function supervisor() {
        return $this->belongsTo(SuperVisor::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }

}
