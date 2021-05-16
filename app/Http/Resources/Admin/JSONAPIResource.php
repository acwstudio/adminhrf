<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;

class JSONAPIResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type(),
            'attributes' => $this->allowedAttributes(),
            'relationships' => $this->prepareRelationships()
        ];
    }

    private function prepareRelationships()
    {
        return collect(config("jsonapi.resources.{$this->type()}.relationships"))
            ->flatMap(function ($related){
                $relatedType = $related['type'];
                $relationships = $related['method'];
                return [
                    $relatedType => [
                        'links' => [
                            'self'
                            => route(
                                "{$this->type()}.relationships.{$relatedType}", $this->id
                            ),
                            'related' => route(
                                "{$this->type()}.{$relatedType}", $this->id
                            ),
                        ],
                        'data' => !$this->whenLoaded($relationships) instanceof MissingValue ?
                            JSONAPIIdentifierResource::collection($this->{$relationships}) :
                            new MissingValue(),
                    ],
                ];
            });
    }

    private function relations()
    {
        return collect(config("jsonapi.resources.{$this->type()}.relationships"))
            ->map(function($relation){
                return JSONAPIResource::collection($this->whenLoaded(
                    $relation['method']));
            });
    }

    /**
     * @param $request
     * @return Collection
     */
    public function included($request): Collection
    {
        return collect($this->relations())
            ->filter(function ($resource) {
                return $resource->collection !== null;
            })
            ->flatMap(function ($resource) use ($request) {
                return $resource->flatten($request);
            });
    }

    /**
     * @param Request $request
     * @return array
     */
    public function with($request)
    {
        $with = [];
        if ($this->included($request)->isNotEmpty()) {
            $with['included'] = $this->included($request);
        }
        return $with;
    }
}
