<?php

namespace App\Http\Resources\Admin\Audiomaterial;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAudiomaterialIdentifierResource
 * @package App\Http\Resources\Admin\Audiomaterial
 */
class AdminAudiomaterialIdentifierResource extends JsonResource
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
            'type' => 'audiomaterials'
        ];
    }
}
