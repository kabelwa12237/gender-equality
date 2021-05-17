<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return ['id' => $this->id,
        'name'=>$this->name, 'contact'=>$this->contact, 'latitude'=>$this->latitude, 'longitude'=>$this->longitude, 'report'=>$this->reports
    ];
    }
}
