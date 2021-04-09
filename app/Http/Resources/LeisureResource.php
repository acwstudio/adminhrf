<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeisureResource extends JsonResource
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
            'model_type' => 'leisure',
            'id' => $this->id,
            'title' => $this->title,
	    'slug' =>$this->slug,
            'count' => $this->count,
        ];
    }
}
