<?php

namespace App\Http\Resources\Admin\Test;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminTestCollection
 * @package App\Http\Resources\Admin
 */
class AdminTestCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
