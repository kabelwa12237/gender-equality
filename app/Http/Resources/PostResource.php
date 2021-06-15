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
            'id' => $this->id,
            'author_name' => $this->user->name,
            'title' => $this->title,
            'avatar' => $this->user->avatar,
            'content' => $this->body,   
            'comments' => $this->comments,
            'reactions' => $this->reactions,
            'reaction_count' => count($this->reactions),
            'comments_count' => count($this->comments),
            'image' => $this->getFirstMediaUrl(),
            'time' => $this->created_at->diffForHumans(),
        ];
    }
}
