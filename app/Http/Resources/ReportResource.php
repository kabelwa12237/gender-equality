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
            'caption'=>$this->body,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'organizations'=>$this->organizations,
             'user'=>$this->user,
            'media'=>$this-> getMedia(),
            'media_type'=>$this->media_type,
            'time'=>$this->created_at->diffForHumans(),

        ];
    }
}
