<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class EventResource extends JsonResource
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
            'model_type' => 'event',
            'id'     => $this->id,
            'user_id'   => $this->user_id,
            'title'  => $this->title,
            'slug'  => $this->slug,
            'body'  => $this->body,
            'published_at'  => $this->published_at,
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
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $this->checkLiked($request->get('user_id', 1)),
            'has_bookmark'  => false,
            'event_date' => Carbon::parse(($this->event_date))->format('Y-m-d'),
            'group_date' => Carbon::parse(($this->event_date))->format('Y-m'),
            'event_start_date' => Carbon::parse(($this->event_start_date))->format('Y-m-d'),
            'event_end_date' => Carbon::parse(($this->event_end_date))->format('Y-m-d'),
            //TODO:  Change event date to event date from timeline entity
            'tags' => TagResource::collection($this->tags),
            'comments' => $this->comments,
        ];
    }
}
