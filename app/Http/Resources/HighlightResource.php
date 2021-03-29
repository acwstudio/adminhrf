<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class HighlightResource extends JsonResource
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
            'highlight','audiomaterial','videomaterial'
        ];
        $user = $request->user();
        return [
            'model_type' => in_array($map, $this->highlightable_type)?$this->highlightable->type:$this->highlightable_type,
            'id' => $this->highlightable->id,
            'slug' => $this->highlightable->slug,
            'title' => $this->highlightable->title,
            'surname' => $this->highlightable_type=='biography'?$this->surname:null,
            'firstname' => $this->highlightable_type=='biography'?$this->firstname:null,
            'birth_date' => $this->highlightable_type=='biography'?Carbon::parse(($this->birth_date))->format('Y-m-d'):null,
            'group_date' => $this->highlightable_type=='biography'?Carbon::parse(($this->birth_date))->format('Y-m'):null,
            'death_date' => $this->highlightable_type=='biography'?Carbon::parse(($this->death_date))->format('Y-m-d'):null,
            'announce' => $this->highlightable->announce,
            'published_at' => $this->highlightable->published_at,
            'video_code' => $this->highlightable_type=='videomaterial'?explode('"',$this->highlightable->video_code)[0]:null,
//            'author' => AuthorShortResource::collection($this->highlightable->authors),
            'path' => $this->highlightable_type=='audiomaterial'?$this->path:null,
            'comments' => $this->highlightable->countComments(),
            'likes' => $this->highlightable_type!='news'?$this->highlightable->countLikes():null,
            'views' => $this->viewed,
            'has_like' => $user&&$this->highlightable_type!='news'? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
            'image' => [
                "model_type" => "image",
                "id" => 1294,
                "alt" => null,
                "src" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt.jpg",
                "preview" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt_min.jpg",
                "original" => null,
                "order" => 1
            ],
        ];
    }
}
