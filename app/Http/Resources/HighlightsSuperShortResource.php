<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HighlightsSuperShortResource extends JsonResource
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
            'model_type' => $this->highlightable_type,
            'id' => $this->highlightable->id,
            'title' => $this->highlightable_type=='biography'?
                $this->highlightable->title:$this->highlightable->lastname.' '.
                $this->highlightable->firstname.' '.
                $this->highlightable->patronymic,
            'slug' => $this->highlightable->slug,
//            'surname' => $this->highlightable->surname,
//            'lastname' => $this->highlightable->surname,
//            'patronymic' => $this->highlightable->surname,
        ];
    }
}
