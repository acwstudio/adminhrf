<?php

namespace App\Http\Resources\Admin\DocumentCategory;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminDocumentCategoryIdentifierResource
 * @package App\Http\Resources\Admin\DocumentCategory
 */
class AdminDocumentCategoryIdentifierResource extends JsonResource
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
            'type' => 'documentcategories',
        ];
    }
}
