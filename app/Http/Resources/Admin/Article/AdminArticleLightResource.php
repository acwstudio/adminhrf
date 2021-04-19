<?php

namespace App\Http\Resources\Admin\Article;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminArticleLightResource
 * @package App\Http\Resources\Admin\Article
 */
class AdminArticleLightResource extends JsonResource
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
            'id' => $this->id,
            'type' => 'articles',
            'title' => $this->title
        ];
    }
}
