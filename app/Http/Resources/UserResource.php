<?php

namespace App\Http\Resources;

use App\Modules\Admin\Models\Admin;
use App\Modules\Diractor\Models\Diractor;
use App\Modules\Responsable\Models\Responsable;
use App\Modules\SuperVisor\Models\SuperVisor;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type ='';
        switch ($this->child_type){
            case Diractor::class : $type = 'Directeur'; $tab['stores'] = $this->child->company->stores; break;
            case Responsable::class : $type = 'Responsable';$tab['store'] = $this->child->store ; break;
            case SuperVisor::class : $type = 'Superviseur'; $tab['stores'] = $this->child->stores; break;
            case Admin::class : $type = 'Admin';break;
        }
        $tab = parent::toArray($request);
        unset($tab['child_type'], $tab['child_id']);
        $tab['type'] = $type;

        return $tab;
    }
}
