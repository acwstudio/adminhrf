<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'model_type' => 'image',
            'id'     => $this->id,
            'alt'  => $this->title,
            'src'  => $this->src,
            'preview'  => $this->preview,
            'original'  => $this->original,
            'order' => $this->order,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
