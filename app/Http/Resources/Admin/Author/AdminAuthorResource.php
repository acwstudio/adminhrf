<?php

namespace App\Http\Resources\Admin\Author;

use App\Http\Resources\Admin\AdminImageResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialIdentifierResource;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAuthorResource
 * @package App\Http\Resources\Admin
 */
class AdminAuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'authors',
            'slug' => $this->slug,
            'attributes' => [
                'firstname' => $this->firstname,
                'surname' => $this->surname,
                'patronymic' => $this->patronymic,
                'birth_date' => $this->birth_date,
                'announce' => $this->announce,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'articles' => [
                    'links' => [
                        'self' => route('authors.relationships.articles', ['author' => $this->id]),
                        'related' => route('authors.articles', ['author' => $this->id])
                    ],
                    'data' => AdminArticleResource::collection(
                        $this->whenLoaded('articles')
                    ),
                ],
                'videomaterials' => [
                    'links' => [
                        'self' => route('authors.relationships.videomaterials', ['author' => $this->id]),
                        'related' => route('authors.videomaterials', ['author' => $this->id])
                    ],
                    'data' => AdminVideomaterialResource::collection(
                        $this->whenLoaded('video')
                    ),
                ],
                'image' => [
                    'links' => [
                        'self' => route('author.relationships.image', ['author' => $this->id]),
                        'related' => route('author.image', ['author' => $this->id])
                    ],
                    'data' => new AdminImageResource($this->whenLoaded('image')),
                ]
            ],
        ];
    }
}
