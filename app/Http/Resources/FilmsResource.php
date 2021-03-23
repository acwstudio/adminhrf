<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmsResource extends JsonResource
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
            'model_type' => 'film',
            'title' => $this->title,
            'slug' => $this->slug,
            'video_code' => $this->video_code,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'authors' => AuthorShortResource::collection($this->authors),
            'comments' => $this->comments,
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => false,
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
