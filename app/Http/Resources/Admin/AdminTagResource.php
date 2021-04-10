<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
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
                        'self' => route('tags.relationships.articles', ['tag' => $this->id]),
                        'related' => route('tags.articles', ['tag' => $this->id])
                    ],
                    'data' => AdminArticleIdentifireResource::collection($this->whenLoaded('articles'))
                ],
                'documents' => [
                    'links' => [
                        'self' => route('tags.relationships.documents', ['tag' => $this->id]),
                        'related' => route('tags.documents', ['tag' => $this->id])
                    ],
                    'data' => AdminDocumentsIdentifireResource::collection($this->whenLoaded('documents'))
                ],
                'news' => [
                    'links' => [
                        'self' => route('tags.relationships.news', ['tag' => $this->id]),
                        'related' => route('tags.news', ['tag' => $this->id])
                    ],
                    'data' => AdminNewsIdentifireResource::collection($this->whenLoaded('news'))
                ],
                'biographies' => [
                    'links' => [
                        'self' => route('tags.relationships.biographies', ['tag' => $this->id]),
                        'related' => route('tags.biographies', ['tag' => $this->id])
                    ],
                    'data' => AdminBiographiesIdentifireResource::collection($this->whenLoaded('biographies'))
                ],
            ]
        ];
    }
}
