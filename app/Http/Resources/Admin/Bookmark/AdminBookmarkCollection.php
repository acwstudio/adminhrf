<?php

namespace App\Http\Resources\Admin\Bookmark;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminBookmarkCollection
 * @package App\Http\Resources\Admin
 */
class AdminBookmarkCollection extends ResourceCollection
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
