<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QCategoryResource extends JsonResource
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
            'model_type' => 'qcategory',
            'id' => $this->id,
            'slug' => $this->slug,
            'text' => $this->text,
            'position' => $this->position

        ];
    }
}
