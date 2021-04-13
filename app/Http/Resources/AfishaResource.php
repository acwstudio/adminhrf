<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AfishaResource extends JsonResource
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
            'model_type' => 'afisha',
            'id' => $this->id,
#            'slug' =>$this->slug,
            'title' => $this->title,
            'link' => $this->link,
            'views' => $this->viewed,
            'body' => $this->body,
            'street' => $this->street,
            'afisha_date' => $this->afisha_date,
#            'has_bookmark' => $user?$this->hasBookmark($user):false,
            'city' => CityResource::make($this->city),
            'leisure' => LeisureResource::make($this->leisure),
            'comments' => CommentResource::collection($this->comments),
            'likes' => $this->liked,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'image' => $this->images->count() > 0 ? ImageResource::make($this->images()->orderBy('order', 'asc')->first()) : [
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
