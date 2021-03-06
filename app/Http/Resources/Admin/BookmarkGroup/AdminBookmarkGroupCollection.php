<?php

namespace App\Http\Resources\Admin\BookmarkGroup;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminBookmarkGroupCollection
 * @package App\Http\Resources\Admin
 */
class AdminBookmarkGroupCollection extends ResourceCollection
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
