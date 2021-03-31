<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
		'model_type'=>'magazine_category',
		'id' => $this->id,
		'type_text' => $this->type_text,
		'created_at'=> $this->created_at,
		'articles' =>MagazineArticleShortResource::make($this->article)
	];
    }
}
