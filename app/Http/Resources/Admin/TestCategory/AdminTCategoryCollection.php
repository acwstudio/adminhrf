<?php

namespace App\Http\Resources\Admin\TestCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminTCategoryCollection
 * @package App\Http\Resources\Admin\TestCategory
 */
class AdminTCategoryCollection extends ResourceCollection
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
