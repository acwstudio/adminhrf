<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideolectureResource extends JsonResource
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
            'video_code' => explode('"',$this->video_code)[0],
            'body' => $this->body,
            'published_at' => $this->published_at,
//            'authors' => AuthorShortResource::collection($this->whenLoaded('authors')),
            'lector' => AuthorShortResource::collection($this->authors),
            'comments' => CommentResource::collection($this->comments),
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
