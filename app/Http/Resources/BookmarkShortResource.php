<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $arr = [true,false];
        return [
            'model_type' => $this->entity,
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'publsihed_at' => $this->published_at,
            'viewed' => $this->viewed,
            'announce' => $this->announce,
            'likes' => $this->entity=='news'?null:$this->countLikes(),
            #'comments' => $this->countComments(),
            'has_liked' => $this->entity=='news'?null:$this->checkLiked($request->get('user_id',0)),
            'has_bookmarked' => $arr[rand(0,1)],
            'tags' => TagResource::collection($this->tags),

        ];
    }
}
