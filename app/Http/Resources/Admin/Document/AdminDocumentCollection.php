<?php

namespace App\Http\Resources\Admin\Document;

use App\Http\Resources\Admin\Document\AdminDocumentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminDocumentCollection
 * @package App\Http\Resources\Admin
 */
class AdminDocumentCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = AdminDocumentResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
