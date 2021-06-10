<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'body' => $this->body,
            'user_id' => $this->user_id,
            'posts'=>$this->posts,
            'reactions'=>$this->reactions,
            'comments'=>$this->comments,
            'comment'=>$this->comment,
            'time'=>$this->created_at->diffForHumans(),   



        ];
    }
}
