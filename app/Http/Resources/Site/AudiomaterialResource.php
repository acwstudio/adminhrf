<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AudiomaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();

        return [
            'model_type' => 'audiolecture',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'path' => $this->filepath,
            'position' => $this->position,
            'likes' => $this->liked,
            'views' => $this->viewed,
            'comments' => CommentResource::collection($this->comments),
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
        ];
    }
}
