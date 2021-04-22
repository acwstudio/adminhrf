<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class UserShortResource extends JsonResource
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
            'image' => ImageResource::make($image),
            'status' => $this->status
        ];
    }
}
