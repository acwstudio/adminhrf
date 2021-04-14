<?php

namespace App\Http\Resources\Admin\Biography;

use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBiographyResource
 * @package App\Http\Resources\Admin
 */
class AdminBiographyResource extends JsonResource
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
            'type' => 'biography',
            'slug' => $this->slug,
            'attributes' => [
                'surname' => $this->surname,
                'firstname' => $this->firstname,
                'patronymic' => $this->patronymic,
                'birth_date' => $this->birth_date,
                'death_date' => $this->death_date,
                'announce' => $this->announce,
                'description' => $this->description,
                'government_start' => $this->government_start,
                'government_end' => $this->government_end,
                'published_at' => $this->published_at,
                'viewed' => $this->viewed,
                'biblio' => $this->biblio,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'tags' => [
                    'links' => [
                        'self' => route('biographies.relationships.tags', ['biography' => $this->id]),
                        'related' => route('biographies.tags', ['biography' => $this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                ],
                'categories' => [
                    'links' => [
                        'self' => route('biographies.relationships.biocategories', ['biography' => $this->id]),
                        'related' => route('biographies.biocategories', ['biography' => $this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                ],
            ],

//            'tags' => AdminTagResource::collection($this->tags),
//            'likes' => $this->likes,
//            'bookmarks' => $this->bookmarks,
//            'images' => $this->images,
//            'categories' => $this->categories,
        ];
    }
}
