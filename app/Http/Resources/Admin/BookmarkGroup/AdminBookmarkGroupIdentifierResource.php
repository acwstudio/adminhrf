<?php

namespace App\Http\Resources\Admin\BookmarkGroup;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBookmarkGroupIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminBookmarkGroupIdentifierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'bookmarkgroups'
        ];
    }
}
