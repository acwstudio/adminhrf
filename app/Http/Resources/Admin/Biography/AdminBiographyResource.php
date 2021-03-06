<?php

namespace App\Http\Resources\Admin\Biography;

use App\Http\Resources\Admin\Bookmark\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkResource;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Http\Resources\Admin\AdminImageResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\BioCategory\AdminBioCategoryResource;
use App\Http\Resources\Admin\Tag\AdminTagResource;
use App\Http\Resources\Admin\TimeLine\AdminTimelineIdentifierResource;
use App\Http\Resources\Admin\TimeLine\AdminTimelineResource;
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
                    'data' => AdminTagResource::collection($this->whenLoaded('tags'))
                ],
                'categories' => [
                    'links' => [
                        'self' => route('biographies.relationships.biocategories', ['biography' => $this->id]),
                        'related' => route('biographies.biocategories', ['biography' => $this->id])
                    ],
                    'data' => AdminBioCategoryResource::collection($this->whenLoaded('categories'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('biography.relationships.images', ['biography' => $this->id]),
                        'related' => route('biography.images', ['biography' => $this->id])
                    ],
                    'data' => AdminImageResource::collection($this->whenLoaded('images'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('biography.relationships.bookmarks', ['biography' => $this->id]),
                        'related' => route('biography.bookmarks', ['biography' => $this->id])
                    ],
                    'data' => AdminBookmarkResource::collection($this->whenLoaded('bookmarks'))
                ],
                'timeline' => [
                    'links' => [
                        'self' => route('biography.relationships.timeline', ['biography' => $this->id]),
                        'related' => route('biography.timeline', ['biography' => $this->id])
                    ],
                    'data' => new AdminTimelineResource($this->whenLoaded('timeline'))
                ]
            ],

//            'likes' => $this->likes,

        ];
    }
}
