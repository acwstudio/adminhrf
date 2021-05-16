<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\HighlightsSuperShortResource;
use App\Http\Resources\Site\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Highlight;
class HighlightShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return [
            'model_type' => $this->type,
	    'id' =>$this->id,
            'title' => $this->title,
	    'slug' => $this->slug,
            'announce' => $this->announce,
            'published_at' => $this->published_at,
            'count' => $this->highlightable->count(),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
#            'image' => $this->images?ImageResource::make($this->images->first()):null,
	  'image' => $this->images?ImageResource::make($this->images->first()):null,
	  'list' => HighlightsSuperShortResource::collection($this->highlightable()->limit(5)->get())
        ];
    }
}
