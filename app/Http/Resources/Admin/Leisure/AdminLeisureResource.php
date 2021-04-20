<?php

namespace App\Http\Resources\Admin\Leisure;

use App\Http\Resources\Admin\Event\AdminEventResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminLeisureResource
 * @package App\Http\Resources\Admin\Leisure
 */
class AdminLeisureResource extends JsonResource
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
            'type' => 'leisures',
            'slug' => 'slug',
            'attributes' => [
                'title' => $this->title,
                'active' => $this->active,
                'count' => $this->count,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'events' => [
                    'links' => [
                        'self' => route('leisure.relationships.event', ['leisure' => $this->id]),
                        'related' => route('leisure.event', ['leisure' => $this->id])
                    ],
                    'data' => new AdminEventResource($this->whenLoaded('events'))
                ]
            ]
        ];
    }
}
