<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTCategoryResource
 * @package App\Http\Resources\Admin
 */
class AdminTCategoryResource extends JsonResource
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
            'type' => 'tcategories',
            'slug' => $this->slug,
            'attributes' => [
                'text' => $this->text,
                'position' => $this->position,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'tests' => [
                    'links' => [
//                        'self' => route('tags.relationships.articles', ['tag' => $this->id]),
//                        'related' => route('tags.articles', ['tag' => $this->id])
                    ],
//                    'data' => AdminArticlesIdentifireResource::collection($this->whenLoaded('articles'))
                ],
            ]
        ];
    }
}
