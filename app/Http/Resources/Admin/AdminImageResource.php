<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminImageResource
 * @package App\Http\Resources\Admin
 */
class AdminImageResource extends JsonResource
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
            'type' => 'images',
            'attributes' => [
                'path' => $this->path,
                'name' => $this->name,
                'ext' => $this->ext,
                'alt' => $this->alt,
                'order' => $this->order,
                'imageable_id' => $this->imageable_id,
                'imageable_type' => $this->imageable_type,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'flags' => $this->flags,
            ],
            'relationships' => [
                'articles' => [
                    'links' => [
//                        'self' =>
//                        'related' =>
                    ],
//                    'data'
                ]
            ]
        ];
    }
}
