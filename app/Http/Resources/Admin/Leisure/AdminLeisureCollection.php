<?php

namespace App\Http\Resources\Admin\Leisure;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminLeisureCollection
 * @package App\Http\Resources\Admin\Leisure
 */
class AdminLeisureCollection extends ResourceCollection
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
