<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'birth_date' => Carbon::parse(($this->birth_date))->format('Y-m-d'),
            'group_date' => Carbon::parse(($this->birth_date))->format('Y-m'),
            'death_date' => Carbon::parse(($this->death_date))->format('Y-m-d'),
            'slug' => $this->slug,
            'published_at' => $this->published_at,
            'image' => ImageResource::make($this->images()->first()),
            'likes' => $this->liked,
            'views' => $this->viewed,
            'comments' => $this->commented,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => false,
            'categories' => BioCategoryResource::collection($this->categories),
            'tags' => $this->tags,
        ];
    }
}
