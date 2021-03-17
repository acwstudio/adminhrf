<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'model_type' => 'author',
            'id'     => $this->id,
            'firstname'  => $this->firstname,
            'surname'  => $this->surname,
            'patronymic'  => $this->patronymic,
            'fullname' => $this->fullname,
            'articles_count' => $this->articles_count,
            'articles' => new ArticleCollection($this->articles->take(10))
        ];
    }
}
