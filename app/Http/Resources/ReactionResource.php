<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReactionResource extends JsonResource
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
            'emoji' => $this->emoji,
            'type' => $this->type,
            'time'=>$this->created_at->diffForHumans(), 
            'reactionable'=>$this->reactionable,
            'user_id' => $this->user_id,  
        ];
    }
}
