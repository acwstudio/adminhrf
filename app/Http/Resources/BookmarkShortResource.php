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
        //$arr = [true, false];
        return [
            'model_type' => $this->entity=='videomaterial'||$this->entity=='highlight'?$this->type:$this->entity,
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'patronymic' => $this->patronymic,
            'publsihed_at' => $this->published_at,
            'viewed' => $this->viewed,
            'announce' => $this->announce,
            'likes' => $this->entity == 'news' ? null : $this->liked,
            'comments' => $this->commented,
            'iframe' => $this->iframe,
            'has_like' => $this->entity == 'news' ? null : $this->checkLiked($user),
            'has_bookmark' => $user?$this->hasBookmark($user):false,
            'tags' => TagResource::collection($this->tags),

        ];
    }
}
