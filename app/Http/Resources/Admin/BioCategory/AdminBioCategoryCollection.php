<?php

namespace App\Http\Resources\Admin\BioCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminBioCategoryCollection
 * @package App\Http\Resources\Admin\BioCategory
 */
class AdminBioCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
