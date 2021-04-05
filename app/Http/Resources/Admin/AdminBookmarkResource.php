<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBookmarkResource
 * @package App\Http\Resources\Admin
 */
class AdminBookmarkResource extends JsonResource
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
            'type' => 'bookmarks',
            'attributes' => [
                'group_id' => $this->group_id,
                'bookmarkable_type' => $this->bookmarkable_type,
                'bookmarkable_id' => $this->bookmarkable_id,
                'created_at' => $this->created_at
            ],
            'relationships' => [
                'bookmarkGroup' => [
                    'links' => [
                        'related' => route('bookmarks.bookmarkgroup', ['bookmark' => $this->id])
                    ]
                ]
            ]
        ];
    }
}
