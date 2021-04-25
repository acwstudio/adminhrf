<?php

namespace App\Http\Resources\Admin\Like;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminLikeResource
 * @package App\Http\Resources\Admin\Like
 */
class AdminLikeResource extends JsonResource
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
            'type' => 'likes',
            'attributes' => [
                'user_id' => $this->user_id,
                'likeable_id' => $this->likeable_id,
                'likeable_type' => $this->likeable_type,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }

}
