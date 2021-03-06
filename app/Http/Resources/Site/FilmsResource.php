<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\ImageResource;
use App\Http\Resources\Site\AuthorShortResource;
use App\Http\Resources\Site\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use function optional;

class FilmsResource extends JsonResource
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
            'model_type' => 'film',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'video_code' => explode('"', $this->video_code)[0],
            'body' => $this->body,
            'published_at' => $this->published_at,
            'authors' => AuthorShortResource::collection($this->authors),
            'comments' => CommentResource::collection($this->comments),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
            'image' => ImageResource::make(optional($this->images)->first()),

        ];
    }
}
