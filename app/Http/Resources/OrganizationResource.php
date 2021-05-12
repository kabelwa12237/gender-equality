<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\type;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact' => $this->contact,
            'type' => $this->type,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address
        ];
    }
}
