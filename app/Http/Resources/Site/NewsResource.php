<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\CommentResource;
use App\Http\Resources\Site\ImageResource;
use App\Http\Resources\Site\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return [
            'model_type' => 'news',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'close_commentation' => $this->close_commentation,
            'image' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'published_at' => $this->published_at,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments),
            'views' => $this->viewed,
        ];
    }
}
