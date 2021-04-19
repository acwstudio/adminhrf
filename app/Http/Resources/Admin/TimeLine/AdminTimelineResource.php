<?php

namespace App\Http\Resources\Admin\TimeLine;

use App\Http\Controllers\Admin\Timeline\AdminTimelineTimelineableRelatedController;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
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
                        'self' => route('timeline.relationships.timelineable', ['timeline' => $this->id]),
                        'related' => route('timeline.timelineable', ['timeline' => $this->id])
                    ],

                    'data' => $this->selectResource()
                ]
            ]
        ];
    }

    /**
     * @return AdminArticleResource|AdminBiographyResource
     */
    private function selectResource()
    {
        if ($this->timelinable_type === 'article') {
            return new AdminArticleResource($this->whenLoaded('timelinable'));
        } elseif ($this->timelinable_type === 'biography') {
            return new AdminBiographyResource($this->whenLoaded('timelinable'));
        } else {
            return null;
        }
    }
}
