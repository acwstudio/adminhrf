<?php

namespace App\Http\Resources\Site;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ArticleShortResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return parent::toArray($request);
    }
}
