<?php

namespace App\Http\Resources\Admin\BioCategory;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBioCategoryIdentifierResource
 * @package App\Http\Resources\Admin\BioCategory
 */
class AdminBioCategoryIdentifierResource extends JsonResource
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
            'type' => 'biocategories'
        ];
    }
}
