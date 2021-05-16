<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\AuthorResource;
use App\Http\Resources\Site\CommentResource;
use App\Http\Resources\Site\ImageResource;
use App\Http\Resources\Site\ArticleCategoryResource;
use App\Http\Resources\Site\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'user_id' => $user ? $user->id : null,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'image' => ImageResource::make($this->images()->first()),
            'authors' => AuthorResource::collection($this->authors),
            'likes' => $this->liked,
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments),
            'category' => ArticleCategoryResource::make($this->category),
        ];
    }
}
