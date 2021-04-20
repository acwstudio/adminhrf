<?php

namespace App\Http\Resources\Admin\TestMessage;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminMessageCollection
 * @package App\Http\Resources\Admin\TestMessage
 */
class AdminMessageCollection extends ResourceCollection
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
