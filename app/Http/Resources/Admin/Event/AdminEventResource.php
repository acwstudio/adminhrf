<?php

namespace App\Http\Resources\Admin\Event;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminEventResource
 * @package App\Http\Resources\Admin\Event
 */
class AdminEventResource extends JsonResource
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
            'type' => 'events',
            'attributes' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'commented' => $this->commented,
                'liked' => $this->liked,
                'body' => $this->body,
                'announce' => $this->announce,
                'afisha_date' => $this->afisha_date,
                'published_at' => $this->published_at,
                'street' => $this->street,
                'city_id' => $this->city_id,
                'leisure_id' => $this->leisure_id,
                'link' => $this->link,
                'title' => $this->title,
                'viewed' => $this->viewed,
            ],
            'relationships' => [
                'images' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                'comments' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                'likes' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                'leisure' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                'city' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ]
            ]
        ];
    }
}
