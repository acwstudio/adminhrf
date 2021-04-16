<?php

namespace App\Http\Resources\Admin\Podcast;

use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminPodcastResource
 * @package App\Http\Resources\Admin
 */
class AdminPodcastResource extends JsonResource
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
            'type' => 'podcasts',
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'iframe' => $this->iframe,
                'order' => $this->order,
                'viewed' => $this->viewed,
                'commented' => $this->commented,
                'liked' => $this->liked,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'tags' => [
                    'links' => [
                        'self' => route('podcasts.relationships.tags', ['podcast' => $this->id]),
                        'related' => route('podcasts.relationships.tags', ['podcast' => $this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('podcast.relationships.images', ['podcast' => $this->id]),
                        'related' => route('podcast.images', ['podcast' => $this->id])
                    ],
                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('podcast.relationships.bookmarks', ['podcast' => $this->id]),
                        'related' => route('podcast.bookmarks', ['podcast' => $this->id])
                    ],
                    'data' => AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
                ],
            ]
        ];
    }
}
