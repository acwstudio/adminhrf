<?php

namespace App\Http\Resources\Admin\Like;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminLikeIdentifierResource
 * @package App\Http\Resources\Admin\Like
 */
class AdminLikeIdentifierResource extends JsonResource
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
            'type' => 'likes'
        ];
    }
}
