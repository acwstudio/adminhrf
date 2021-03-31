<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryResource extends JsonResource
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
            'model_type' => 'article_category',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'old_slug' => 'category'.'-'.$this->id
        ];
    }
}
