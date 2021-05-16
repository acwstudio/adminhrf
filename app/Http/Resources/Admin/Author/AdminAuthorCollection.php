<?php

namespace App\Http\Resources\Admin\Author;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;

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
        return  [
            'data' => $this->collection,
            'included' => $this->mergeIncludedRelations($request),
        ];
    }

    /**
     * @param $request
     * @return MissingValue|Collection
     */
    private function mergeIncludedRelations($request): MissingValue|Collection
    {
        $includes = $this->collection->flatMap(function ($resource) use(
            $request){
            return $resource->included($request);
        });
        return $includes->isNotEmpty() ? $includes : new MissingValue();
    }
}
