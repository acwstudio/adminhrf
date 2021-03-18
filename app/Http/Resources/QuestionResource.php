<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'model_type' => 'question',
            'answer' => AnswerResource::collection($this->answers),
            'text' => $this->text,
            'type' => $this->type,
            'position' => $this->position,
            'has_points' => $this->has_points,
            'points'=>$this->points,
        ];
    }
}
