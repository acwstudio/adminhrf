<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'model_type' => 'comment',
            'id' => $this->id,
            'published_at' => $this->created_at,
            'user_id' => $this->user_id,
            'text' => $this->text,
            'parents' => $this->parents,
            #'likes' => $this->likes()->count(),
            'commented_model_id' => $this->commentable_id,
            'commented_model_type' => $this->commentable_type,
        ];
    }
}
