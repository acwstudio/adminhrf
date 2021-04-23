<?php

namespace App\Http\Resources\Admin\BookmarkGroup;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBookmarkGroupResource
 * @package App\Http\Resources\Admin
 */
class AdminBookmarkGroupResource extends JsonResource
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
            'type' => 'bookmarkgroups',
            'attributes' => [
                'user_id' => $this->user_id,
                'title' => $this->title,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
