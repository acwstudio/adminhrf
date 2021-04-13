<?php

namespace App\Http\Resources\Admin\Like;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminLikeCollection
 * @package App\Http\Resources\Admin\Like
 */
class AdminLikeCollection extends ResourceCollection
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
