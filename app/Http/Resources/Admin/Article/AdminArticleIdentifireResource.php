<?php

namespace App\Http\Resources\Admin\Article;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminArticleIdentifireResource
 * @package App\Http\Resources\Admin
 */
class AdminArticleIdentifireResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => 'articles'
        ];
    }
}
