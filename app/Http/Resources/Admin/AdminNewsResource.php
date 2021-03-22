<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminNewsResource extends JsonResource
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
            'model_type' => 'news',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'yatextid' => $this->yatextid,
            'announce' => $this->announce,
            'listorder' => $this->listorder,
            'body' => $this->body,
            'show_in_rss' => $this->show_in_rss,
            'status' => $this->status,
            'show_in_main' => $this->show_in_main,
            'show_in_afisha' => $this->show_in_afisha,
            'close_commentation' => $this->close_commentation,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'viewed' => $this->viewed,
            'images' => $this->images,
            'tags' => $this->tags,
            'comments' => $this->comments,
            'bookmarks' => $this->bookmarks
        ];
    }
}
