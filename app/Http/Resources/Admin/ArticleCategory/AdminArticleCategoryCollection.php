<?php

namespace App\Http\Resources\Admin\ArticleCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminArticleCategoryCollection
 * @package App\Http\Resources\Admin
 */
class AdminArticleCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
