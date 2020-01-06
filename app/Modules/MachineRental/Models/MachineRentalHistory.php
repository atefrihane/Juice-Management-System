<?php

namespace App\Modules\MachineRental\Models;

use App\Modules\Machine\Models\MachineRental;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class MachineRentalHistory extends Model {

    //
   protected $guarded = ['id'];

   public function rental(){
       return $this->belongsTo(MachineRental::class,'machine_rental_id');
   }

   public function user()
   {
       return $this->belongsTo(User::class, 'user_id');
   }

 


}
