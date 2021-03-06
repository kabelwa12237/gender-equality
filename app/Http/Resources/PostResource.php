<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'reactions'=>$this->reactions,
            'comments'=>$this->comments,
            'media'=>$this->getMedia(),
            'time'=>$this->created_at->diffForHumans()
        ];
    }
}
