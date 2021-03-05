<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'model_type' => 'news',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'show_in_main' => $this->show_in_main,
            'close_commentation' => $this->close_commentation,
            #'banner' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'created_at' => $this->created_at,
            'published_at' => $this->updated_at,
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments),
            #'likes' => $this->countLikes(),
            #'views' => $this->getViews(),
        ];
    }
}
