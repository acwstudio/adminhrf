<?php

namespace App\Http\Resources\Admin\Tag;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTagLightResource
 * @package App\Http\Resources\Admin
 */
class AdminTagLightResource extends JsonResource
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
            'type' => 'tags',
            'title' => $this->title
        ];
    }
}
