<?php

namespace App\Http\Resources;

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
            'announce' => $this->announce,
            'city' =>$this->city,
            'street' => $this->street,
            'afisha_date' => $this->afisha_date,
            'has_bookmark' => $user?$this->hasBookmark($user):false,

        ];
    }
}
