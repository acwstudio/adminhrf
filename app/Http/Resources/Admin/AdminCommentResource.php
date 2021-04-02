<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminCommentResource
 * @package App\Http\Resources\Admin
 */
class AdminCommentResource extends JsonResource
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
            'type' => 'comments',
            'slug' => $this->slug,
            'attributes' => [
                'user_id' => $this->user_id,
                'text' => $this->text,
                'commentable_id' => $this->commentable_id,
                'commentable_type' => $this->commentable_type,
                'parent_id' => $this->parent_id,
                'answer_to' => $this->answer_to,
                'liked' => $this->liked,
                'children_count' => $this->children_count,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'articles' => [
                    'links' => [
//                        'self' => route('admin.comments.article'),
//                        'related' =>
                    ],

//                    'data' => AdminArticlesIdentifireResource::collection($this->article)
//                    'data' => AdminArticlesIdentifireResource::collection($this->whenLoaded('articles'))
                ]
            ]
        ];
    }
}
