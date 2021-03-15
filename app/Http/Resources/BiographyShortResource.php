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
            'image_id' => $this->image_id,




        ];
    }
}
