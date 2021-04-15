<?php

namespace App\Http\Resources\Admin\Videomaterial;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminVideomaterialCollection
 * @package App\Http\Resources\Admin\Videomaterial
 */
class AdminVideomaterialCollection extends ResourceCollection
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
