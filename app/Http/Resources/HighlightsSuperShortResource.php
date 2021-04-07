<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ImageResource;

class HighlightsSuperShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $map = [
            'videomaterial'
        ];
        $notMap = [
            'news',
            'highlight',
            'event',
            'audiomaterial',
            'biography'
        ];

        $user = $request->user();
        $arr = in_array($this->highlightable_type, $map) ? $this->highlightable->type : $this->highlightable_type;
        if ($arr == 'audiomaterial')
        {
            $arr = 'audiolecture';
        }

        return $this->highlightable ? [
            'model_type' => $arr,
            'id' => $this->highlightable_id,
            'title' => $this->highlightable_type != 'biography'
                ? $this->highlightable->title
                : $this->highlightable->surname.
                  ' '.
                  $this->highlightable->firstname.
                  ' '.
                  $this->highlightable->patronymic,
            'slug' => $this->highlightable ? $this->highlightable->slug : null,
            'image' => $this->highlightable->images ? ImageResource::make($this->highlightable->images()->first())
                : null,
        ] : null;
    }
}
