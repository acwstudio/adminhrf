<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoLectureShortResource extends JsonResource
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
            'model_type' => 'lecture',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'video_code' => explode('"',$this->video_code)[0],
            'published_at' => $this->published_at,
            'lector' => AuthorShortResource::collection($this->authors),
            'comments' => $this->commented,
            'likes' => $this->liked,
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
            //'image' => ImageResource::collection($this->whenLoaded('images')),
            'image' => [
                "model_type" => "image",
                "id" => 1294,
                "alt" => null,
                "src" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt.jpg",
                "preview" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt_min.jpg",
                "original" => null,
                "order" => 1
            ],
        ];
    }
}
