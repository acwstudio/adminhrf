<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class DocumentResource extends JsonResource
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
            'body' => $this->body,
            'file' => Str::startsWith($this->file, '/') ? $this->file : Str::of($this->file)->prepend('/'),
            'document_date' => $this->document_date,
            'document_text_date' => $this->document_text_date,
            'options' => $this->options,
            'images' => ImageResource::collection($this->images),
	        'has_bookmark' => $user?$this->hasBookmark($user):false,
        ];
    }
}
