<?php

namespace App\Http\Resources;

use App\Models\Image;
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
            $image = new Image([

                "path" => "/images/user/",
                "name" => "blank-avatar",
                "ext" => "jpg",
                "flags" => Image::SRC_FLAG + Image::PREVIEW_FLAG

            ]);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getRole(),
            'permissions' => $this->getPermissionsArray(),
            'image' => ImageResource::make($image),
            'status' => $this->status

        ];
    }
}
