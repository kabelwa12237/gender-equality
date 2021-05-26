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
        // return parent::toArray($request);
        return[
            "id"=>$this->id,
            "user_id"=>$this->user_id,
            "reactionable_id"=>$this->reactionable_id,
            "reactionable_type"=>$this->reactionable_type,
            "type"=>$this->type,
            "emoji"=>$this->emoji,
        ];
    }
}
