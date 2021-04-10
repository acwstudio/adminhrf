<?php

namespace App\Http\Resources\Admin\ArticleCategory;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminArticleCategoryResource
 * @package App\Http\Resources\Admin
 */
class AdminArticleCategoryResource extends JsonResource
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
            'id' => $this->id,
            'type' => 'articlecategories',
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
