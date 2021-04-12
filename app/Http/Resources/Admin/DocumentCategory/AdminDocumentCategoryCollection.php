<?php

namespace App\Http\Resources\Admin\DocumentCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminDocumentCategoryCollection
 * @package App\Http\Resources\Admin\DocumentCategory
 */
class AdminDocumentCategoryCollection extends ResourceCollection
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
