<?php

namespace App\Http\Resources\Admin\ArticleCategory;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminArticleCategoryLightResource
 * @package App\Http\Resources\Admin
 */
class AdminArticleCategoryLightResource extends JsonResource
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
            'title' => $this->title
        ];
    }
}
