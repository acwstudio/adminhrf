<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkShortResource extends JsonResource
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
        $arr = [true, false];
        return [
            'model_type' => $this->entity,
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'publsihed_at' => $this->published_at,
            'viewed' => $this->viewed,
            'announce' => $this->announce,
            'likes' => $this->entity == 'news' ? null : $this->liked,
            #'comments' => $this->countComments(),
            'has_like' => $this->entity == 'news' ? null : $this->checkLiked($user),
            'has_bookmarked' => $this->hasBookmark($user),
            'tags' => TagResource::collection($this->tags),

        ];
    }
}
