<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();

        return [
            'model_type' => $this->type,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'user' => UserShortResource::make($this->user),
            'text' => $this->text,
            'parent_id' => $this->parent_id,
            'rate' => $this->rate,
            'has_rate' => $user ? $this->checkRated($user) : false,
            'answer_to' => $this->answer_to,
            'children_count' => $this->children_count,
            $this->mergeWhen($this->type === 'review', [
                'estimate' => $this->estimate,
            ]),
            $this->mergeWhen($request->routeIs('popular.comments', 'profile.comments'), [
                'resource' => [
                    'model_type' => $this->commentable_type,
                    'id' => $this->commentable_id,
                    'title' => optional($this->commentable)->title,
                    'slug' => optional($this->commentable)->slug,
                ]
            ]),
        ];
    }
}
