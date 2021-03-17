<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TimelineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'model_type' => $this->timelinable_type,
            'id' => $this->timelinable_id,
            'announce' => $this->timelinable->announce,
            'date' => Carbon::parse(($this->date))->format('Y-m'),
            'title'=> $this->timelinable_type=='biography'?$this->timelinable->surname.' '.$this->timelinable->firstname:$this->timelinable->title,
            'slug'  => $this->timelinable->slug,
            'published_at'  => $this->timelinable->published_at,
            'likes' => $this->timelinable->countLikes(),
            'views' => $this->timelinable->viewed,
            'has_like' => $this->timelinable->checkLiked($request->get('user_id', 1)),
            'has_bookmark'  => false,

            'tags' => TagResource::collection($this->timelinable->tags),
            'comments' => $this->timelinable->comments->count(),
            'image' => [
                "model_type"=>"image",
                "id"=>1294,
                "alt"=> null,
                "src"=> "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt.jpg",
                "preview"=> "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt_min.jpg",
                "original"=> null,
                "order"=>1
            ],
            //'image' => ImageResource::make($this->images()->orderBy('order', 'asc')->first()),



            //'authors' => AuthorResource::collection($this->authors),
            //'event_date' => Carbon::parse(($this->event_date))->format('Y-m-d'),
            //'event_start_date' => Carbon::parse(($this->event_start_date))->format('Y-m-d'),
            //'event_end_date' => Carbon::parse(($this->event_end_date))->format('Y-m-d'),
        ];
    }
}
