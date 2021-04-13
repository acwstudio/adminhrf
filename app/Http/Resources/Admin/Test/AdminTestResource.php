<?php

namespace App\Http\Resources\Admin\Test;

use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\AdminMessagesIdentifierResource;
use App\Http\Resources\Admin\AdminQuestionsIdentifireResource;
use App\Http\Resources\Admin\AdminResultsIdentifierResource;
use App\Http\Resources\Admin\AdminTCategoryIdentifierResource;
use App\Http\Resources\Admin\Like\AdminLikeIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTestResource
 * @package App\Http\Resources\Admin
 */
class AdminTestResource extends JsonResource
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
            'type' => 'tests',
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'is_active' => $this->is_active,
                'time' => $this->time,
                'total_question' => $this->total_question,
                'max_points' => $this->max_points,
                'has_points' => $this->has_points,
                'viewed' => $this->viewed,
                'is_reversable' => $this->is_reversable,
                'is_ege' => $this->is_ege,
                'published_at' => $this->published_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'images' => [
                    'links' => [
                        'self' => route('test.relationships.images', ['test' => $this->id]),
                        'related' => route('test.images', ['test' => $this->id])
                    ],
                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
//                    'data' => AdminImageResource::collection($this->whenLoaded('images'))
                ],
                'comments' => [
                    'links' => [
                        'self' => route('test.relationships.comments', ['test' => $this->id]),
                        'related' => route('test.comments', ['test' => $this->id])
                    ],
                    'data' => AdminCommentsIdentifierResource::collection($this->whenLoaded('comments'))
                ],
                'questions' => [
                    'links' => [
                        'self' => route('tests.relationships.questions', ['test' => $this->id]),
                        'related' => route('tests.questions', ['test' => $this->id])
                    ],
                    'data' => AdminQuestionsIdentifireResource::collection($this->whenLoaded('questions'))
                ],
                'messages' => [
                    'links' => [
                        'self' => route('test.relationships.messages', ['test' => $this->id]),
                        'related' => route('test.messages', ['test' => $this->id])
                    ],
                    'data' => AdminMessagesIdentifierResource::collection($this->whenLoaded('messages'))
                ],
                'results' => [
                    'links' => [
                        'self' => route('test.relationships.results', ['test' => $this->id]),
                        'related' => route('test.results', ['test' => $this->id])
                    ],
                    'data' => AdminResultsIdentifierResource::collection($this->whenLoaded('results'))
                ],
                'categories' => [
                    'links' => [
                        'self' => route('tests.relationships.test-categories', ['test' => $this->id]),
                        'related' => route('tests.test-categories', ['test' => $this->id])
                    ],
                    'data' => AdminTCategoryIdentifierResource::collection($this->whenLoaded('categories'))
                ],
                'likes' => [
                    'links' => [
                        'self' => route('test.relationships.likes', ['test' => $this->id]),
                        'related' => route('test.likes', ['test' => $this->id])
                    ],
                    'data' => AdminLikeIdentifierResource::collection($this->whenLoaded('likes'))
                ]
            ]
        ];
    }
}
