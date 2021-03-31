<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        $arr = in_array($this->highlightable_type, $map) ? $this->highlightable->type : $this->highlightable_type;
        if ($arr == 'audiomaterial') {
            $arr = 'audiolecture';
        }
        return [
            'model_type' => $arr, //(in_array($this->highlightable_type, $map)?$this->highlightable->type:$this->highlightable_type=='audiomaterial')?'audiolecture':$this->highlightable_type,
            'id' => $this->taggable,
            'slug' => $this->highlightable->slug,
            'title' => $this->highlightable->title,
            'surname' => $this->highlightable_type == 'biography' ? $this->highlightable->surname : null,
            'firstname' => $this->highlightable_type == 'biography' ? $this->highlightable->firstname : null,
            'birth_date' => $this->highlightable_type == 'biography' ? Carbon::parse(($this->highlightable->birth_date))->format('Y-m-d') : null,
            'group_date' => $this->highlightable_type == 'biography' ? Carbon::parse(($this->highlightable->birth_date))->format('Y-m') : null,
            'death_date' => $this->highlightable_type == 'biography' ? Carbon::parse(($this->highlightable->death_date))->format('Y-m-d') : null,
            'announce' => $this->highlightable->announce,
            'published_at' => $this->highlightable->published_at,
            'video_code' => $this->highlightable_type == 'videomaterial' ? explode('"', $this->highlightable->video_code)[0] : null,
            'author' => !in_array($this->highlightable_type, $notMap) ? AuthorShortResource::collection($this->highlightable->authors) : null,
            'path' => $this->highlightable_type == 'audiomaterial' ? $this->highlightable->path : null,
            'comments' => $this->highlightable->countComments(),
            'likes' => $this->highlightable_type != 'news' ? $this->highlightable->countLikes() : null,
            'views' => $this->viewed,
            'has_like' => $user && $this->highlightable_type != 'news' ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
            ];
    }
}
