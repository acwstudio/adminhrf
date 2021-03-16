<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleShortResource extends JsonResource
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
            'model_type' => 'article',
            'id'     => $this->id,
            'title'  => $this->title,
            'slug'  => $this->slug,
            'announce'  => $this->announce,
            'published_at'  => $this->published_at,
            'authors' => AuthorShortResource::collection($this->authors),
            'comments' => $this->comments->count(),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $this->checkLiked($request->get('user_id', 0)),
            'has_bookmark'  => false,
            'image' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'tags' => TagResource::collection($this->tags),
        ];
    }
}
