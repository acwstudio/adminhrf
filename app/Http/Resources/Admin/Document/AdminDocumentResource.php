<?php

namespace App\Http\Resources\Admin\Document;

use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\DocumentCategory\AdminDocumentCategoryIdentifierResource;
use App\Http\Resources\Admin\DocumentCategory\AdminDocumentCategoryResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminDocumentResource
 * @package App\Http\Resources\Admin
 */
class AdminDocumentResource extends JsonResource
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
            'type' => 'documents',
            'attributes' => [
                'document_category_id' => $this->document_category_id,
                'title' => $this->title,
                'slug' => $this->slug,
                'announce' => $this->announce,
                'body' => $this->body,
                'file' => $this->file,
                'document_date' => $this->document_date,
                'document_text_date' => $this->document_text_date,
                'options' => $this->options,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'liked' => $this->liked
            ],
            'relationships' => [
                'tags' => [
                    'links' => [
                        'self' => route('documents.relationships.tags', [$this->id]),
                        'related' => route('documents.tags', [$this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('document.relationships.images', ['document' => $this->id]),
                        'related' => route('document.images', ['document' => $this->id])
                    ],
                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                ],
                'category' => [
                    'links' => [
                        'self' => route('document.relationships.document-category', ['document' => $this->id]),
                        'related' => route('document.document-category', ['document' => $this->id])
                    ],
                    'data' => new AdminDocumentCategoryIdentifierResource($this->whenLoaded('category'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('document.relationships.bookmarks', ['document' => $this->id]),
                        'related' => route('document.bookmarks', ['document' => $this->id])
                    ],
                    'data' => AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
                ],
            ]
        ];
    }
}
