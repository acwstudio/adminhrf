<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        if (is_null($image = $this->image)) {
            $image = [
                "model_type" => "image",
                "alt" => null,
                "src" => "/images/user/blank-avatar.jpg",
                "preview" => "/images/user/blank-avatar_min.jpg",
                "original" => null,
                "order" => 1
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getRole(),
            'permissions' => $this->getPermissionsArray(),
            'image' => $image

        ];
    }
}
