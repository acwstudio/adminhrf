<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\AuthorShortResource;
use App\Http\Resources\Site\ImageResource;
use App\Http\Resources\Site\ArticleCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleSearchResource extends JsonResource
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
            'comments' => $this->commented,
            'likes' => $this->liked,
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
            'image' => $this->images ? ImageResource::make($this->images->first()) : null,
            'authors' => AuthorShortResource::collection($this->authors),
//            'tags' => TagResource::collection($this->tags),
            'category' => $this->categories ? ArticleCategoryResource::make($this->category) : null
        ];
    }
}
