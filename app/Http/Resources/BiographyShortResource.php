<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BiographyShortResource extends JsonResource
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
            'model_type' => 'biography',
            'surname' => $this->surname,
            'firstname' => $this->firstname,
            'patronymic' => $this->patronymic,
            'announce' => $this->announce,
            'birthname' => $this->birthname,
            'birth_date' => $this->birth_date,
            'group_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'slug' => $this->slug,
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
