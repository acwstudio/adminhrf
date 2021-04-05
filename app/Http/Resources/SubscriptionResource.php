<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $map = [
            'highlight', 'videomaterial'
        ];
        $notMap = [
            'news', 'highlight', 'event', 'audiomaterial', 'biography'
        ];
        $user = $request->user();
        $arr = in_array($this->taggable_type, $map) ? $this->taggable->type : $this->taggable_type;
        if ($arr == 'audiomaterial') {
            $arr = 'audiolecture';
        }
        return [
            'model_type' => $arr, //(in_array($this->taggable_type, $map)?$this->taggable->type:$this->taggable_type=='audiomaterial')?'audiolecture':$this->taggable_type,
            'id' => $this->taggable->id,
            'slug' => $this->taggable->slug,
            'title' => $this->taggable->title,
            'surname' =>$this->taggable->surname ,
            'firstname' =>$this->taggable->firstname ,
            'birth_date' => $this->taggable->birth_date ? Carbon::parse(($this->taggable->birth_date))->format('Y-m-d') : null,
            'death_date' => $this->taggable->death_date ? Carbon::parse(($this->taggable->death_date))->format('Y-m-d') : null,
            'announce' => $this->taggable->announce,
            'published_at' => $this->taggable->published_at,
            'video_code' => $this->taggable_type == 'videomaterial' ? explode('"', $this->taggable->video_code)[0] : null,
            'author' => !in_array($this->taggable_type, $notMap) ? AuthorShortResource::collection($this->taggable->authors) : null,
            'path' => $this->taggable_type == 'audiomaterial' ? $this->taggable->path : null,
            'comments' => $this->taggable->countComments(),
            'likes' => $this->taggable_type != 'news' && $this->taggable_type != 'audiomaterial'? $this->taggable->countLikes() : null,
            'views' => $this->viewed,
#            'has_like' => $user && $this->taggable_type != 'news' && $this->taggable_type != 'audiomaterial' ? $this->taggable->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->taggable->hasBookmark($user) : false,
	    'image' => ImageResource::make($this->taggable->images()->first()),
	    'tags' => TagResource::collection($this->taggable->tags),
            ];
    }
}
