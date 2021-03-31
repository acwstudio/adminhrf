<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleShortResource extends JsonResource
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
            'model_type' => 'article',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'published_at' => $this->published_at,
            'authors' => AuthorShortResource::collection($this->whenLoaded('authors')),
            'comments' => $this->commented,
            'likes' => $this->liked,
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
            'image' => ImageResource::make($this->whenLoaded('images')->shift()),
            'tags' => TagResource::collection($this->tags),
            'category' => ArticleCategoryResource::collection($this->category)
        ];
    }
}
