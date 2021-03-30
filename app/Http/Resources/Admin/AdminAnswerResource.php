<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAnswerResource
 * @package App\Http\Resources\Admin
 */
class AdminAnswerResource extends JsonResource
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
            'type' => 'answers',
            'attributes' => [
                'question_id' => $this->question_id,
                'title' => $this->title,
                'is_right' => $this->is_right,
                'description' => $this->description,
                'points' => $this->points,
            ],
            'relationships' => [
                'question' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ]
                ]
            ]
        ];
    }
}
