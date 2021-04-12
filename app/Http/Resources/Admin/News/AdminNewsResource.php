<?php

namespace App\Http\Resources\Admin\News;

use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminNewsResource
 * @package App\Http\Resources\Admin
 */
class AdminNewsResource extends JsonResource
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
            'id' => $this->id,
            'type' => 'news',
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'yatextid' => $this->yatextid,
                'announce' => $this->announce,
                'listorder' => $this->listorder,
                'body' => $this->body,
                'show_in_rss' => $this->show_in_rss,
                'status' => $this->status,
                'show_in_main' => $this->show_in_main,
                'show_in_afisha' => $this->show_in_afisha,
                'close_commentation' => $this->close_commentation,
                'published_at' => $this->published_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'viewed' => $this->viewed,
            ],
            'relationships' => [
                'images' => [
                    'links' => [
                        'self' => route('news.relationships.images', ['news' => $this->id]),
                        'related' => route('news.images', ['news' => $this->id])
                    ],
                    'data' =>AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                ],
                'comments' => [
                    'links' => [
                        'self' => route('news.relationships.comments', ['news' => $this->id]),
                        'related' => route('news.comments', ['news' => $this->id])
                    ],
                    'data' => AdminCommentsIdentifierResource::collection($this->whenLoaded('comments'))
                ],
                'tags' => [
                    'links' => [
                        'self' => route('news.relationships.tags', ['news' => $this->id]),
                        'related' => route('news.relationships.tags', ['news' => $this->id])
                    ],
                    'data' =>AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('news.relationships.bookmarks', ['news' => $this->id]),
                        'related' => route('news.bookmarks', ['news' => $this->id])
                    ],
                    'data' =>AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
                ]
            ]
        ];
    }
}
