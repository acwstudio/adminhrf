<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BiographyShortResource extends JsonResource
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
            'surname' => $this->surname,
            'firstname' => $this->firstname,
            'patronymic' => $this->patronymic,
            'announce' => $this->announce,
            'birthname' => $this->birthname,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'slug' => $this->slug,
            'published_at'  => $this->published_at,
            'banner' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $this->checkLiked($request->get('user_id', 1)),
            'has_bookmark'  => false,
            'categories' => BioCategoryResource::collection($this->categories),
            'comments' => $this->comments->count(),
        ];
    }
}
