<?php

namespace App\Http\Resources\Admin\Audiomaterial;

use App\Http\Resources\Admin\Audiofile\AdminAudiofileResource;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkResource;
use App\Http\Resources\Admin\AdminHighlightResource;
use App\Http\Resources\Admin\AdminImageResource;
use App\Http\Resources\Admin\Tag\AdminTagResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAudiomaterialResource
 * @package App\Http\Resources\Admin\Audiomaterial
 */
class AdminAudiomaterialResource extends JsonResource
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
            'type' => 'audiomaterials',
            'attributes' => [
                'parent_id' => $this->parent_id,
                'title' => $this->title,
                'description' => $this->description,
                'position' => $this->position,
                'show_in_rss_apple' => $this->show_in_rss_apple,
                'viewed' => $this->viewed,
                'commented' => $this->commented,
                'liked' => $this->liked,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'tags' => [
                    'links' => [
                        'self' => route('audiomaterials.relationships.tags', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterials.tags', ['audiomaterial' => $this->id])
                    ],
//                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                    'data' => AdminTagResource::collection($this->whenLoaded('tags'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('audiomaterial.relationships.images', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterial.images', ['audiomaterial' => $this->id])
                    ],
//                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                    'data' => AdminImageResource::collection($this->whenLoaded('images'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('audiomaterial.relationships.bookmarks', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterial.bookmarks', ['audiomaterial' => $this->id])
                    ],
//                    'data' => AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
                    'data' => AdminBookmarkResource::collection($this->whenLoaded('bookmarks'))
                ],
                'highlights' => [
                    'links' => [
                        'self' => route('audiomaterials.relationships.highlights', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterials.highlights', ['audiomaterial' => $this->id])
                    ],
//                    'data' => AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
                    'data' => AdminHighlightResource::collection($this->whenLoaded('highlights'))
                ],
                'audiofiles' => [
                    'links' => [
                        'self' => route('audiomaterial.relationships.audiofile', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterial.audiofile', ['audiomaterial' => $this->id])
                    ],
                    'data' => new AdminAudiofileResource($this->whenLoaded('audiofile'))
                ]
            ]
        ];
    }
}
