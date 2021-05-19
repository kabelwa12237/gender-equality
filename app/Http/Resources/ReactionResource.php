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
        return  ['id' => $this->id,
        'type'=>$this->type, 'emoji'=>$this->emoji, 'post'=>$this->post, 'comment'=>$this->comment
    ];
    }
}
