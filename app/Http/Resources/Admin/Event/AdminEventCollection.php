<?php

namespace App\Http\Resources\Admin\Event;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminEventCollection
 * @package App\Http\Resources\Admin\Event
 */
class AdminEventCollection extends ResourceCollection
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
