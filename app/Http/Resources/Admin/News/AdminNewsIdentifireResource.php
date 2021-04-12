<?php

namespace App\Http\Resources\Admin\News;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminNewsIdentifireResource
 * @package App\Http\Resources\Admin
 */
class AdminNewsIdentifireResource extends JsonResource
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
            'type' => 'news'
        ];
    }
}
