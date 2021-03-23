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
            'model_type' => 'comment',
            'id' => $this->id,
            'created_at' => $this->created_at,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                ],
            'text' => $this->text,
            'parent_id' => $this->parent_id,
            'likes' => $this->liked,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'answer_to' => $this->answer_to,
            'children_count' => $this->children_count,
        ];
    }
}
