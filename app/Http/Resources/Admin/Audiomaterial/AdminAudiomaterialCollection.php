<?php

namespace App\Http\Resources\Admin\Audiomaterial;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminAudiomaterialCollection
 * @package App\Http\Resources\Admin\Tag
 */
class AdminAudiomaterialCollection extends ResourceCollection
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
