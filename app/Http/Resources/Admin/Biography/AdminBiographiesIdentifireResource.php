<?php

namespace App\Http\Resources\Admin\Biography;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBiographiesIdentifireResource
 * @package App\Http\Resources\Admin
 */
class AdminBiographiesIdentifireResource extends JsonResource
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
            'type' => 'biographies'
        ];
    }
}
