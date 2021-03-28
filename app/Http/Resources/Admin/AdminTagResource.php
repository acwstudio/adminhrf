<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTagResource
 * @package App\Http\Resources\Admin
 */
class AdminTagResource extends JsonResource
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
            'type' => 'tags',
            'slug' => $this->slug,
            'attributes' => [
                'title' => $this->title,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'articles' => [
                    'links' => [
//                        'self' => route('', ['article' => $this->id]),
//                        'related' => route('tags.articles', ['tag' => $this->id])
                    ],
                    'data' => AdminArticlesIdentifireResource::collection($this->whenLoaded('articles'))
                ],
            ]
        ];
    }
}
