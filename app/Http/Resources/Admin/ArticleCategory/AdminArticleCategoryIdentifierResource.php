<?php

namespace App\Http\Resources\Admin\ArticleCategory;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminArticleCategoryIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminArticleCategoryIdentifierResource extends JsonResource
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
            'type' => 'articlecategory'
        ];
    }
}
