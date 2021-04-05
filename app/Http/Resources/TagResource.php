<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'model_type' => 'tag',
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'has_subscribed' =>$user? $this->hasSubscription($user):false,
        ];
    }
}
