<?php

namespace App\Modules\Product\Models;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        parent::toArray($request)['mixtures'] = $this->mixtures;
        return parent::toArray($request);
    }
}
