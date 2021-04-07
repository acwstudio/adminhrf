<?php

namespace App\Http\Resources;

use App\Models\Leisure;
use Illuminate\Http\Resources\Json\JsonResource;

class AfishaShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return [
            'model_type' => 'afisha',
            'id' => $this->id,
            'slug' =>$this->slug,
            'title' =>$this->title,
            'link'=>$this->link,
            'views'=>$this->viewed,
            'announce' => $this->announce,
            'street' => $this->street,
            'afisha_date' => $this->afisha_date,
            'has_bookmark' => $user?$this->hasBookmark($user):false,
            'city' => CityResource::make($this->city),
            'leisure' => LeisureResource::make($this->leisure),
            'comment' => $this->commented,
            'likes' => $this->liked,
        ];
    }
}
