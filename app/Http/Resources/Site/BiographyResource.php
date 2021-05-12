<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\ImageResource;
use App\Http\Resources\Site\BioCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BiographyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();

        return [
            'id' => $this->id,
            'surname' => $this->surname,
            'firstname' => $this->firstname,
            'patronymic' => $this->patronymic,
            'announce' => $this->announce,
            'description' => $this->description,
            'birthname' => $this->birthname,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'slug' => $this->slug,
            'biblio' => $this->biblio,
            'published_at' => $this->published_at,
            'image' => ImageResource::make($this->images()->first()),
            'likes' => $this->liked,
            'views' => $this->viewed,
            'comments' => $this->commented,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
            'categories' => BioCategoryResource::collection($this->categories),
            'tags' => $this->tags,

        ];
    }
}
