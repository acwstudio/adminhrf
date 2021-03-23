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
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $this->checkLiked($request->get('user_id', 1)),
            'has_bookmark' => false,
            'categories' => BioCategoryResource::collection($this->categories),
            'comments' => $this->comments->count(),
            'tags' => $this->tags,
        ];
    }
}
