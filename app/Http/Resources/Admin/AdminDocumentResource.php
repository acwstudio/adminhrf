<?php

namespace App\Http\Resources\Admin;

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
            'model_type' => 'document',
            'id' => $this->id,
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
            'images' => $this->images,
            'tags' => $this->tags,
            'category' => $this->category,
            'comments' => $this->comments,
            'likes' => $this->likes,
            'bookmarks' => $this->bookmarks,
        ];
    }
}
