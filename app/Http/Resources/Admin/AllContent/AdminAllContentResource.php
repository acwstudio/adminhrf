<?php

namespace App\Http\Resources\Admin\AllContent;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAllContentResource
 * @package App\Http\Resources\Admin
 */
class AdminAllContentResource extends JsonResource
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
            'type' => $this->type,
            'attributes' => [
                'title' => $this->title,
                'created_at' => $this->created_at
            ]
        ];
    }
}
