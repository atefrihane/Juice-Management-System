<?php

namespace App\Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

protected $fillable = ['code','status','name','country','email','tel','designation','city','zip_code','address','complement','comment','logo'];

}
