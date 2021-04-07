<?php

namespace App\Http\Resources\Admin;

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
                    'data' => AdminTagsIdentifierResource::collection($this->whenLoaded('tags'))
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
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
                ],
            ]
        ];
    }
}
