<?php

namespace App\Http\Resources\Admin\Bookmark;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBookmarkIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminBookmarkIdentifierResource extends JsonResource
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
            'type' => 'bookmarks'
        ];
    }
}
