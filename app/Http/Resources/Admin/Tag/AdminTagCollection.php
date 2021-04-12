<?php

namespace App\Http\Resources\Admin\Tag;

use App\Http\Resources\Admin\Tag\AdminTagResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminTagCollection
 * @package App\Http\Resources\Admin
 */
class AdminTagCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = AdminTagResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
