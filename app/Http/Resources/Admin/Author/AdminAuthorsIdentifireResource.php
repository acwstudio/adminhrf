<?php

namespace App\Http\Resources\Admin\Author;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAuthorsIdentifireResource
 * @package App\Http\Resources\Admin
 */
class AdminAuthorsIdentifireResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => 'authors'
        ];
    }
}
