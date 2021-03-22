<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideolectureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return [
            'model_type' => 'lecture',
            'title' => $this->title,
            'slug' => $this->slug,
            'video_code' => $this->video_code,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'authors' => AuthorShortResource::collection($this->whenLoaded('authors')),
            'comments' => $this->comments,
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark'  => false,
            'image' => ImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
