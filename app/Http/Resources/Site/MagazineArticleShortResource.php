<?php

namespace App\Http\Resources\Site;

use Illuminate\Http\Resources\Json\JsonResource;

class MagazineArticleShortResource extends JsonResource
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
		'model_type' => 'magazine_article',
		'id' =>$this->id,
		'author' => $this->author,
		'category' => $this->category,
		'release'=> $this->release,
		'type_text' =>$this->type_text,
		'created_at'=>$this->created_at,
		];
    }
}
