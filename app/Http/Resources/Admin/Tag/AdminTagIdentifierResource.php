<?php

namespace App\Http\Resources\Admin\Tag;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTagIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminTagIdentifierResource extends JsonResource
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
            'type' => 'tags'
        ];
    }
}
