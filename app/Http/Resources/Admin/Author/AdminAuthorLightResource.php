<?php

namespace App\Http\Resources\Admin\Author;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAuthorLightResource
 * @package App\Http\Resources\Admin
 */
class AdminAuthorLightResource extends JsonResource
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
            'type' => 'authors',
            'firstname' => $this->firstname,
            'surname' => $this->surname,
        ];
    }
}
