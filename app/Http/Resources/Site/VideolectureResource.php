<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\AuthorShortResource;
use App\Http\Resources\Site\CommentResource;
use App\Http\Resources\Site\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;
use function optional;

class VideolectureResource extends JsonResource
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
            'model_type' => 'videolecture',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'video_code' => explode('"',$this->video_code)[0],
            'body' => $this->body,
            'published_at' => $this->published_at,
            'authors' => AuthorShortResource::make($this->authors->first()),
            'lector' => AuthorShortResource::make($this->authors->first()),
            'comments' => CommentResource::collection($this->comments),
            'likes' => $this->liked,
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
            'image' => ImageResource::make(optional($this->images)->first()),

        ];
    }
}
