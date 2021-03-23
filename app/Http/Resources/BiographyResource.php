<?php

namespace App\Http\Resources;

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
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $this->checkLiked($request->get('user_id', 1)),
            'has_bookmark' => false,
            'categories' => BioCategoryResource::collection($this->categories),
            'comments' => $this->comments,
            'tags' => $this->tags,

        ];
    }
}
