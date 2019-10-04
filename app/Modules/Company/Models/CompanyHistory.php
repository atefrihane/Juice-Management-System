<?php

namespace App\Modules\Company\Models;

use App\Modules\Company\Models\Company;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class CompanyHistory extends Model
{

    protected $fillable = ['changes', 'company_id', 'user_id'];
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
