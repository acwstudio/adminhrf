<?php

namespace App\Http\Resources\Admin\Article;

use App\Http\Resources\Admin\Article\AdminArticleResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;

/**
 * Class AdminArticleCollection
 * @package App\Http\Resources\Admin
 */
class AdminArticleCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = AdminArticleResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
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
