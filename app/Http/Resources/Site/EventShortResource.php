<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\ImageResource;
use App\Http\Resources\Site\AuthorResource;
use App\Http\Resources\Site\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class EventShortResource extends JsonResource
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
            'model_type' => 'event',
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'published_at' => $this->published_at,
            'image' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'authors' => AuthorResource::collection($this->authors),
            'likes' => $this->liked,
            'views' => $this->viewed,
            'has_like' => $this->checkLiked($request->get('user_id', 1)),
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
            'event_date' => Carbon::parse(($this->event_date))->format('Y-m-d'),
            'group_date' => Carbon::parse(($this->event_date))->format('Y-m'),
            'event_start_date' => Carbon::parse(($this->event_start_date))->format('Y-m-d'),
            'event_end_date' => Carbon::parse(($this->event_end_date))->format('Y-m-d'),
            //TODO:  Change event date to event date from timeline entity
            'tags' => TagResource::collection($this->tags),
            'comments' => $this->commented,
        ];
    }
}
