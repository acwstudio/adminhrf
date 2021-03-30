<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DayInHistoryResource extends JsonResource
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
            'model_type' => 'dayinhistory',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'day' => $this->day,
            'month' => $this->month,
            'url' => $this->url,
            'image' => ImageResource::make($this->image),
        ];
    }
}
