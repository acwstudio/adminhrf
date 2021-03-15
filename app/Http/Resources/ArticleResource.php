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
        $tagsMock = [
            [
                'id' => 1,
                'title' => 'Test Tag',
                'slug' => 'test-tag'
            ],
            [
                'id' => 2,
                'title' => 'Test Tag 2',
                'slug' => 'test-tag-2'
            ]
        ];

        return [
            'model_type' => 'article',
            'id'     => $this->id,
            'user_id'   => $this->user_id,
            'title'  => $this->title,
            'slug'  => $this->slug,
            'announce'  => $this->announce,
            'body'  => $this->body,
            'tags' => $tagsMock, //TagResource::collection($this->tags),
            'published_at'  => $this->published_at,
            'image' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'authors' => AuthorResource::collection($this->authors),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'comments' => $this->comments,
            'has_like' => $this->checkLiked($request->get('user_id', 1)),
            'has_bookmark'  => false,
        ];
    }

}
