<?php

namespace App\Http\Resources\Site;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'model_type' => 'answer',
            'id' => $this->id,
            'is_right' => $this->is_right,
            'description' => $this->description,
            'title' => $this->title,
            'points' => $this->points,
        ];
    }
}
