<?php

namespace App\Http\Resources\Admin\Event;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminEventIdentifierResource
 * @package App\Http\Resources\Admin\Event
 */
class AdminEventIdentifierResource extends JsonResource
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
            'types' => 'events'
        ];
    }
}
