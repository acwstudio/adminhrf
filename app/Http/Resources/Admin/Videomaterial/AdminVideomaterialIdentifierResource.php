<?php

namespace App\Http\Resources\Admin\Videomaterial;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminVideomaterialIdentifierResource
 * @package App\Http\Resources\Admin\Videomaterial
 */
class AdminVideomaterialIdentifierResource extends JsonResource
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
            'type' => 'videomaterials'
        ];
    }
}
