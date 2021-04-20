<?php

namespace App\Http\Resources\Admin\City;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminCityIdentifireResource
 * @package App\Http\Resources\Admin\City
 */
class AdminCityIdentifireResource extends JsonResource
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
            'type' => 'cities'
        ];
    }
}
