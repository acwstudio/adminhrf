<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'model_type' => 'document_category',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'documents_count' => $this->documents_count,
            'image' => ImageResource::make($this->documents()->latest()->first()->images()->orderBy('order', 'asc')->first()),
        ];
    }
}
