<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        $hasSolved = $user?$this->checkSolved($user):false;
        return [
            'model_type' => 'test',
            'id' =>$this->id,
            'title' => $this->title,
            'description' => $this->description,
            'time' => $this->time,
            'is_ege' => $this->is_ege,
            'max_points' => $this->max_points,
            'questions' => $this->questions->count(),
            'is_reversable' => $this->is_reversable,
            'likes' => $this->countLikes(),
            'has_like' => $user?$this->checkLiked($user):null,
            'has_bookmark' => false,
            'image' => $this->images ? ImageResource::make($this->images()->orderBy('order', 'asc')->first()) : null,
            'categories' => QCategoryResource::collection($this->categories),
            'comments' => $this->commented,
            'has_solved' => $hasSolved,
            'test_result' => $hasSolved &&$user->testResult?TestResultResource::collection($user->testResult->firstWhere('test_id',$this->id)):null
        ];
    }
}
