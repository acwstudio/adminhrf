<?php

namespace App\Http\Resources\Admin\City;

use App\Http\Resources\Admin\Event\AdminEventCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminCityResource
 * @package App\Http\Resources\Admin\City
 */
class AdminCityResource extends JsonResource
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
            'type' => 'cities',
            'attributes' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'name' => $this->name,
                'count' => $this->count,
            ],
            'relationships' => [
                'events' => [
                    'links' => [
                        'self' => route('city.relationships.events', ['city' => $this->id]),
                        'related' => route('city.events', ['city' => $this->id])
                    ],
                    'data' => new AdminEventCollection($this->whenLoaded('events'))
                ]
            ]
        ];
    }
}
