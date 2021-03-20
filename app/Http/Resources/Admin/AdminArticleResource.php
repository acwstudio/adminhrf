<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        dump($this->tags);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'body' => $this->body,
            'show_in_rss' => $this->show_in_rss,
            'yatextid' => $this->yatextid,
            'active' => $this->active,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'viewed' => $this->viewed,
            'liked' => $this->liked,
            'commented' => $this->commented,
            'biblio' => $this->biblio,
            'event_date' => $this->event_date,
            'event_start_date' => $this->event_start_date,
            'event_end_date' => $this->event_end_date,
            'tags' => AdminTagResource::collection($this->tags),
            'authors' => AdminAuthorResource::collection($this->whenLoaded('authors')),
            'images' => $this->images,
        ];
    }
}
