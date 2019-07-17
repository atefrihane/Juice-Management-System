<?php

namespace App\Modules\User\Models;

use App\Modules\Diractor\Models\Diractor;
use App\Modules\Responsable\Models\Responsable;
use App\Modules\SuperVisor\Models\SuperVisor;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'code'       ,
        'nom'        ,
        'prenom'     ,
        'civilite'   ,
        'telephone'  ,
        'accessCode' ,
        'password'   ,
        'child_type' ,
        'child_id'   ,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function child(){
        return $this->morphTo();
    }
    public function getType(){
        $type = '';
        switch ($this->child_type){
            case Responsable::class : return 'responsable';break;
            case SuperVisor::class : return 'superviseur';break;
            case Diractor::class : return 'directeur';break;
        }
        return 'admin';
    }
}
