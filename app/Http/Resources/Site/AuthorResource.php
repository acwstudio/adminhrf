<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\Site\ImageResource;
use App\Http\Resources\Site\ArticleCollection;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'model_type' => 'author',
            'id' => $this->id,
            'slug' => $this->slug,
            'firstname' => $this->firstname,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'fullname' => $this->fullname,
            'articles_count' => $this->articles_count,
            'image' => ImageResource::make($image),
            'announce' => $this->announce,
            'description' => $this->description,
            'articles' => new ArticleCollection($this->articles()->with('images')->take(10)->get())
        ];
    }
}
