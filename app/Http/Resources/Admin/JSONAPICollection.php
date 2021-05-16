<?php

namespace App\Http\Resources\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;

class JSONAPICollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = JSONAPIResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'included' => $this->mergeIncludedRelations($request),
        ];
    }

    /**
     * @param $request
     * @return SupportCollection|MissingValue
     */
    private function mergeIncludedRelations($request): SupportCollection|MissingValue
    {
        /** @var Collection $includes */
        $includes = $this->collection->flatMap->included($request)->unique('id');

        return $includes->isNotEmpty() ? $includes : new MissingValue();
    }
}
