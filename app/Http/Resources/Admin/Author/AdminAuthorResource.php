<?php

namespace App\Http\Resources\Admin\Author;

use App\Http\Resources\Admin\AdminImageResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialIdentifierResource;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAuthorResource
 * @package App\Http\Resources\Admin
 */
class AdminAuthorResource extends JsonResource
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
            'relationships' => [
                'articles' => [
                    'links' => [
                        'self' => route('authors.relationships.articles', ['author' => $this->id]),
                        'related' => route('authors.articles', ['author' => $this->id])
                    ],
                    'data' => AdminArticleIdentifireResource::collection($this->whenLoaded('articles')
                    ),
                ],
                'videomaterials' => [
                    'links' => [
                        'self' => route('authors.relationships.videomaterials', ['author' => $this->id]),
                        'related' => route('authors.videomaterials', ['author' => $this->id])
                    ],
                    'data' => AdminVideomaterialIdentifierResource::collection($this->whenLoaded('video')
                    ),
                ],
                'image' => [
                    'links' => [
                        'self' => route('author.relationships.image', ['author' => $this->id]),
                        'related' => route('author.image', ['author' => $this->id])
                    ],
                    'data' => new AdminImagesIdentifierResource($this->whenLoaded('image')),
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    private function relations(): array
    {
        return [
            AdminArticleResource::collection($this->whenLoaded('articles')),
            AdminImageResource::collection($this->whenLoaded('images')),
            AdminVideomaterialResource::collection($this->whenLoaded('videomaterials')),
        ];
    }

    /**
     * @param $request
     * @return Collection|\Illuminate\Support\Collection
     */
    public function included($request)
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
    public function with($request): array
    {
        $with = [];

        if ($this->included($request)->isNotEmpty()) {
            $with['included'] = $this->included($request);
        }
        return $with;
    }
}
