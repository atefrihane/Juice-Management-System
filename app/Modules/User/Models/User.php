<?php

namespace App\Modules\User\Models;


use App\Modules\User\Models\Responsible;
use App\Modules\User\Models\Director;
use App\Modules\Warehouse\Models\Warehouse;
use App\Modules\Order\Models\Order;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'code',
        'nom',
        'prenom',
        'civilite',
        'telephone',
        'accessCode',
        'password',
        'child_type',
        'child_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   

    public function child()
    {
        return $this->morphTo();
    }
    public function getType()
    {

     
        switch ($this->child_type) {
            case Responsible::class:return 'Autre';
                break;
            case Director::class:return 'Directeur';
                break;
        }
        return 'admin';
    }
    public function formatName()
    {
        return ucfirst($this->nom).' '.ucfirst($this->prenom);
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function prepares()
    {
        return $this->hasMany(Order::class);
    }
    public function delivries()
    {
        return $this->hasMany(Order::class);
    }


}
