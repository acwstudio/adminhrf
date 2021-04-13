<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return [
            'model_type' => 'document',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'announce' => $this->announce,
            'document_date' => $this->document_date,
            'document_text_date' => $this->document_text_date,
            'options' => $this->options,
            'image' => ImageResource::make($this->images()->first()),
            'has_bookmark' => $user ? $this->hasBookmark($user) : false,
            'comments' => $this->commented
        ];
    }
}
