<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
	$user=$request->user();
        return [
            'model_type' => 'test',
	    'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'time' => $this->time,
            'is_ege' => $this->is_ege,
            'max_points' => $this->max_points,
            'questions' => QuestionResource::collection($this->questions->sortBy('position')),
            'is_reversable' => $this->is_reversable,
            'likes' => $this->countLikes(),
            'has_like' => $user?$this->checkLiked($user):null,
            'has_bookmark' => false,
            'is_finished' => false,
//            'time_solved' => $this->test->checkSolved(1),
            'image' => $this->images ? ImageResource::make($this->images()->orderBy('order', 'asc')->first()) : null,
            'categories' => QCategoryResource::collection($this->categories),

        ];
    }
}
