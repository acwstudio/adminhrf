<?php

namespace App\Http\Resources\Admin\Author;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminAuthorCollection
 * @package App\Http\Resources\Admin
 */
class AdminAuthorCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = AdminAuthorResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
