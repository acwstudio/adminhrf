<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminHighlightResource
 * @package App\Http\Resources\Admin
 */
class AdminHighlightResource extends JsonResource
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
            'type' => 'highlights',
            'attributes' => [
                'title' => $this->title,
                'announce' => $this->announce,
                'type' => $this->type,
                'order' => $this->order,
                'slug' => $this->slug,
                'published_at' => $this->published_at,
                'active' => $this->active,
                'viewed' => $this->viewed,
                'commented' => $this->commented,
                'liked' => $this->liked,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'images' => [
                    'links' => [
                        'self' => route('highlight.relationships.images', ['highlight' => $this->id]),
                        'related' => route('highlight.images', ['highlight' => $this->id])
                    ],
//                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                    'data' => AdminImageResource::collection($this->whenLoaded('images'))
                ],
                'tags' => [
                    'links' => [
                        'self' => route('highlights.relationships.tags', ['highlight' => $this->id]),
                        'related' => route('highlights.tags', ['highlight' => $this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('comments'))
                ],
            ]
        ];
    }
}
