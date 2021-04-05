<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TimelineResource extends JsonResource
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
            'model_type' => $this->timelinable_type,
            'id' => $this->timelinable_id,
            'announce' => $this->timelinable->announce,
            'date' => Carbon::parse(($this->date))->format('Y-m'),
            'title' => $this->timelinable_type == 'biography' ? $this->timelinable->surname . ' ' . $this->timelinable->firstname : $this->timelinable->title,
            'slug' => $this->timelinable->slug,
            'published_at' => $this->timelinable->published_at,
            'likes' => $this->timelinable->countLikes(),
            'views' => $this->timelinable->viewed,
            'has_like' => $user ? $this->timelinable->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->timelinable->hasBookmark($user): false,
            'tags' => TagResource::collection($this->timelinable->tags),
            'comments' => $this->timelinable->commented,
            'image' => ImageResource::make($this->timelinable->images->first()),
        ];
    }
}
