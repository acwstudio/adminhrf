<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HighlightResource extends JsonResource
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
            'model_type' => $this->highlightable_type,
            'id' => $this->highlightable->id,
            'slug' => $this->highlightable->slug,
            'title' => $this->highlightable->title,
            'announce' => $this->highlightable->announce,
            'published_at' => $this->highlightable->published_at,
            'author' => AuthorShortResource::collection($this->highlightable->authors),
            'comments' => $this->highlightable->countComments(),
            'likes' => $this->highlightable->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
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
