<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\ImageResource;
use App\Http\Resources\Site\AuthorShortResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class HighlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
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
            'id' => $this->highlightable_id,
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
            'has_like' => $user && $this->highlightable_type != 'news' ? $this->highlightable->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->highlightable->hasBookmark($user) : false,
            'image' => $this->highlightable->images ? ImageResource::make($this->highlightable->images->first()) : null,
            /*            'image' => [
                            "model_type" => "image",
                            "id" => 1294,
                            "alt" => null,
                            "src" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt.jpg",
                            "preview" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt_min.jpg",
                            "original" => null,
                            "order" => 1
                        ],*/
        ];
    }
}
