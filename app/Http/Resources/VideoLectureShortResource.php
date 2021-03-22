<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoLectureShortResource extends JsonResource
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
            'announce' =>$this->announce,
            'video_code' => $this->video_code,
            'published_at' => $this->published_at,
            'lector' => AuthorShortResource::collection($this->authors),
            'comments' => $this->countComments(),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark'  => false,
            'image' => ImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
