<?php

namespace App\Http\Resources\Admin\Answer;

use App\Http\Resources\Admin\AdminImageCollection;
use App\Http\Resources\Admin\AdminImageResource;
use App\Http\Resources\Admin\Question\AdminQuestionResource;
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
     * @param \Illuminate\Http\Request $request
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
                        'self' => route('answers.relationships.question', ['answer' => $this->id]),
                        'related' => route('answers.question', ['answer' => $this->id])
                    ],
                    'data' => new AdminQuestionResource($this->whenLoaded('question'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('answer.relationships.images', ['answer' => $this->id]),
                        'related' => route('answer.images', ['answer' => $this->id])
                    ],
                    'data' => new AdminImageCollection($this->whenLoaded('images'))
                ]
            ]
        ];
    }
}
