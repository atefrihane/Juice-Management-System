<?php

namespace App\Modules\Store\Models;

use App\Modules\Store\Models\Store;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreHistory extends Model
{

    protected $fillable = ['changes', 'store_id', 'user_id'];

    public function store()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
