<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminAuthorResource extends JsonResource
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
            'model_type' => 'author',
            'id' => $this->id,
            'slug' => $this->slug,
            'firstname' => $this->firstname,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'birth_date' => $this->birth_date,
            'announce' => $this->announce,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'articles' => AdminArticleResource::collection($this->whenLoaded('articles'))
        ];
    }
}
