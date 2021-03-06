<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'id'=>$this->id,
            'body'=>$this->body,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'organization'=>$this->organizations,
            'media'=>$this->getMedia()
            
        ];
    }
    
}
