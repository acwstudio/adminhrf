<?php

namespace App\Http\Resources\Admin\Event;

use App\Http\Resources\Admin\AdminBookmarkCollection;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Http\Resources\Admin\City\AdminCityResource;
use App\Http\Resources\Admin\Like\AdminLikeCollection;
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
                        'self' => route('event.relationships.images', ['event' => $this->id]),
                        'related' => route('event.images', ['event' => $this->id])
                    ],
                    'data' => new AdminImageCollection($this->whenLoaded('images'))
                ],
                'comments' => [
                    'links' => [
                        'self' => route('event.relationships.comments', ['event' => $this->id]),
                        'related' => route('event.comments', ['event' => $this->id])
                    ],
                    'data' => new AdminCommentCollection($this->whenLoaded('comments'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('event.relationships.bookmarks', ['event' => $this->id]),
                        'related' => route('event.bookmarks', ['event' => $this->id])
                    ],
                    'data' => new AdminBookmarkCollection($this->whenLoaded('bookmarks'))
                ],
                'likes' => [
                    'links' => [
                        'self' => route('events.relationships.likes', ['event' => $this->id]),
                        'related' => route('events.likes', ['event' => $this->id])
                    ],
                    'data' => new AdminLikeCollection($this->whenLoaded('likes'))
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
                        'self' => route('events.relationships.city', ['event' => $this->id]),
                        'related' => route('events.city', ['event' => $this->id])
                    ],
                    'data' => new AdminCityResource($this->whenLoaded('city'))
                ]
            ]
        ];
    }
}
