<?php

namespace App\Http\Resources\Admin\City;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminCityCollection
 * @package App\Http\Resources\Admin\City
 */
class AdminCityCollection extends ResourceCollection
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
