<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'user_id'   => $this->user_id,
            'title'  => $this->title,
            'slug'  => $this->slug,
            'announce'  => $this->announce,
            'body'  => $this->body,
            'tags' => TagResource::collection($this->tags),
            'published_at'  => $this->published_at,
            'banner' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'authors' => AuthorResource::collection($this->authors),
            'views' => $this->viewed,
            'likes' => $this->liked,
            'comments' => $this->commented,
            'has_like'  => false,
            'has_bookmark'  => false
        ];
    }

}
