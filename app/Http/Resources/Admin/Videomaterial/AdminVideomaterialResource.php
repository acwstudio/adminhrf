<?php

namespace App\Http\Resources\Admin\Videomaterial;

use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Author\AdminAuthorsIdentifireResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminVideomaterialResource
 * @package App\Http\Resources\Admin\Videomaterial
 */
class AdminVideomaterialResource extends JsonResource
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
            'type' => 'videomaterials',
            'slug' => $this->slug,
            'attributes' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'body' => $this->body,
                'title' => $this->title,
                'published_at' => $this->published_at,
                'announce' => $this->announce,
                'close_commentation' => $this->close_commentation,
                'video_code' => $this->video_code,
                'show_in_rss' => $this->show_in_rss,
                'show_in_main' => $this->show_in_main,
                'active' => $this->active,
                'viewed' => $this->viewed,
                'type' => $this->type,
                'commented' => $this->commented,
                'liked' => $this->liked,
            ],
            'relationships' => [
                "authors" => [
                    'links' => [
                        'self' => route('videomaterials.relationships.authors', ['videomaterial' => $this->id]),
                        'related' => route('videomaterials.authors', ['videomaterial' => $this->id])
                    ],
                    'data' => AdminAuthorsIdentifireResource::collection($this->whenLoaded('authors'))
                ],
                "tags" => [
                    'links' => [
                        'self' => route('videomaterials.relationships.tags', ['videomaterial' => $this->id]),
                        'related' => route('videomaterials.tags', ['videomaterial' => $this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                ],
                "likes" => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                "bookmarks" => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                "comments" => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                "images" => [
                    'links' => [
                        'self' => route('videomaterial.relationships.images', ['videomaterial' => $this->id]),
                        'related' => route('videomaterial.images', ['videomaterial' => $this->id])
                    ],
                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                ]
            ]
        ];
    }
}
