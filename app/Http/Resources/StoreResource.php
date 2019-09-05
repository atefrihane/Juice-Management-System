<?php

namespace App\Http\Resources;

use App\Modules\MachineRental\Models\MachineRental;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [ 'designation'=> $this->designation,
                    'status'=> $this->status,
                    'country' => $this->country,
                    'city'=> $this->city,
                    'zip_code' => $this->zip_code,
                    'sign' => $this->sign,

            'machines' => $this->machines()];
    }
}
