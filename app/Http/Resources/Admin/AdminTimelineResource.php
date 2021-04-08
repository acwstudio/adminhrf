<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTimelineResource
 * @package App\Http\Resources\Admin
 */
class AdminTimelineResource extends JsonResource
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
            'type' => 'timelines',
            'attributes' => [
                'date' => $this->date,
                'timelinable_type' => $this->timelinable_type,
                'timelinable_id' => $this->timelinable_id,
                'active' => $this->active,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'timelaineable' => [
                    'links' => [
                        'self' => route('timeline.relationships.article', ['timeline' => $this->id]),
                        'related' => route('timeline.article', ['timeline' => $this->id])
                    ]
                ]
//                'article' => [
//                    'links' => [
//                        'self' => route('timeline.relationships.article', ['timeline' => $this->id]),
//                        'related' => route('timeline.article', ['timeline' => $this->id])
//                    ]
//                ],
//                'biography' => [
//                    'links' => [
//                        'self' => route('timeline.relationships.biography', ['timeline' => $this->id]),
//                        'related' => route('timeline.biography', ['timeline' => $this->id])
//                    ]
//                ]
            ]
        ];
    }
}
