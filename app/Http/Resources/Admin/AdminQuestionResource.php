<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminQuestionResource
 * @package App\Http\Resources\Admin
 */
class AdminQuestionResource extends JsonResource
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
                'text' => $this->text,
                'title' => $this->title,
                'position' => $this->position,
                'points' => $this->points,
                'has_points' => $this->has_points,
            ],
            'relationships' => [
                'tests' => [
                    'links' => [
                        'self' => route('questions.relationships.tests', ['question' => $this->id]),
                        'related' => route('questions.tests', ['question' => $this->id])
                    ],
                    'data' => AdminTestsIdentifierResource::collection($this->whenLoaded('tests'))
//                    'data' => AdminTestsIdentifierResource::collection($this->tests)
                ],
                'answers' => [
                    'links' => [
                        'self' => route('question.relationships.answers', ['question' => $this->id]),
                        'related' => route('question.answers', ['question' => $this->id])
                    ],
                    'data' => AdminAnswersIdentifireResource::collection($this->answers)
//                    'data' => AdminAnswerResource::collection($this->whenLoaded('answers'))
                ]
            ]
        ];
    }
}
