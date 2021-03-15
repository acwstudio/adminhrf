<?php

namespace App\Http\Resources;

use App\Models\Like;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsShortResource extends JsonResource
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
            'model_type' => 'news',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'banner' => [
                "model_type"=>"image",
                "id"=>1294,
                "alt"=> null,
                "src"=> "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt.jpg",
                "preview"=> "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt_min.jpg",
                "original"=> null,
                "order"=>1
            ],
            //ImageResource::make($this->images()->orderBy('order', 'asc')->first()),
            'published_at' => $this->published_at,
            'likes' => null,
            'has_like' => null,
            'views' => $this->viewed,
            'tags' => TagResource::collection($this->tags),
            'comments' => $this->comments->count(),

        ];
    }
}
