<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminImagesIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminImagesIdentifierResource extends JsonResource
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
            'type' => 'images'
        ];
    }
}
