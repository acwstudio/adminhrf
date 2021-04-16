<?php

namespace App\Http\Resources\Admin\Audiomaterial;

use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
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
                'path' => $this->path,
                'position' => $this->position,
                'show_in_rss_apple' => $this->show_in_rss_apple,
            ],
            'relationships' => [
                'tags' => [
                    'links' => [
                        'self' => route('audiomaterials.relationships.tags', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterials.tags', ['audiomaterial' => $this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('audiomaterial.relationships.images', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterial.images', ['audiomaterial' => $this->id])
                    ],
                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('audiomaterial.relationships.bookmarks', ['audiomaterial' => $this->id]),
                        'related' => route('audiomaterial.bookmarks', ['audiomaterial' => $this->id])
                    ],
                    'data' => AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
                ]
            ]
        ];
    }
}
