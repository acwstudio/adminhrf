<?php

namespace App\Http\Resources\Admin\TimeLine;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTimelineIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminTimelineIdentifierResource extends JsonResource
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
            'type' => 'timelines'
        ];
    }
}
