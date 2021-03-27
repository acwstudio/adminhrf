<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmsShortResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'video_code' => explode('"',$this->video_code)[0],
            'published_at' => $this->published_at,
            'authors' => AuthorShortResource::collection($this->authors),
            'comments' => $this->countComments(),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $this->hasBookmark($user),
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
