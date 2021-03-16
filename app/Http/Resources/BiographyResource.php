<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BiographyResource extends JsonResource
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
            'surname' => $this->surname,
            'firstname' => $this->firstname,
            'patronymic' => $this->patronymic,
            'description' =>$this->description,
            'birthname' => $this->birthname,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'slug' => $this->slug,
            'biblio' => $this->biblio,
            'published_at'  => $this->published_at,
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
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $this->checkLiked($request->get('user_id', 1)),
            'has_bookmark'  => false,
            'categories' => BioCategoryResource::collection($this->categories),
            'comments' => $this->comments,
            'tags' => $this->tags,

        ];
    }
}
