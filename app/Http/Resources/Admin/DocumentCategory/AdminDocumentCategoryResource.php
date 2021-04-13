<?php

namespace App\Http\Resources\Admin\DocumentCategory;

use App\Http\Resources\Admin\Document\AdminDocumentsIdentifireResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminDocumentCategoryResource
 * @package App\Http\Resources\Admin\DocumentCategory
 */
class AdminDocumentCategoryResource extends JsonResource
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
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationjships' => [
                'documents' => [
                    'links' => [
                        'self' => route(
                            'document-category.relationships.documents',
                            ['document_category' => $this->id]),
                        'related' => route('document-category.documents',
                            ['document_category' => $this->id])
                    ],
                    'data' => AdminDocumentsIdentifireResource::collection($this->whenLoaded('documents'))
                ]
            ]
        ];
    }
}
