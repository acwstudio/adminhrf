<?php

namespace App\Http\Resources\Admin\Article;

use App\Http\Resources\Admin\Author\AdminAuthorResource;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Http\Resources\Admin\AdminImageResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkResource;
use App\Http\Resources\Admin\Tag\AdminTagResource;
use App\Http\Resources\Admin\TimeLine\AdminTimelineIdentifierResource;
use App\Http\Resources\Admin\Author\AdminAuthorsIdentifireResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryIdentifierResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class AdminArticleResource
 * @package App\Http\Resources\Admin
 */
class AdminArticleResource extends JsonResource
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
                'authors' => [
                    'links' => [
                        'self' => route('articles.relationships.authors', ['article' => $this->id]),
                        'related' => route('articles.authors', ['article' => $this->id])
                    ],
                    'data' => AdminAuthorsIdentifireResource::collection($this->whenLoaded('authors'))
//                    'data' => new AdminAuthorCollection($this->whenLoaded('authors'))
                ],
                'comments' => [
                    'links' => [
                        'self' => route('article.relationships.comments', ['article' => $this->id]),
                        'related' => route('article.comments', ['article' => $this->id])
                    ],
                    'data' => AdminCommentsIdentifierResource::collection($this->whenLoaded('comments'))
//                    'data' => AdminCommentResource::collection($this->whenLoaded('comments'))
                ],
                'tags' => [
                    'links' => [
                        'self' => route('articles.relationships.tags', ['article' => $this->id]),
                        'related' => route('articles.tags', ['article' => $this->id])
                    ],
                    'data' => AdminTagIdentifierResource::collection($this->whenLoaded('tags'))
//                    'data' => AdminTagResource::collection($this->whenLoaded('tags'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('article.relationships.images', ['article' => $this->id]),
                        'related' => route('article.images', ['article' => $this->id])
                    ],
                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
//                    'data' => new AdminImageCollection($this->whenLoaded('images'))
//                    'data' => AdminImageResource::collection($this->whenLoaded('images'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('article.relationships.bookmarks', ['article' => $this->id]),
                        'related' => route('article.bookmarks', ['article' => $this->id])
                    ],
                    'data' => AdminBookmarkIdentifierResource::collection($this->whenLoaded('bookmarks'))
//                    'data' => new AdminBookmarkCollection($this->whenLoaded('bookmarks'))
                ],
                'category' => [
                    'links' => [
                        'self' => route('articles.relationships.article-category', ['article' => $this->id]),
                        'related' => route('articles.article-category', ['article' => $this->id])
                    ],
                    'data' => new AdminArticleCategoryIdentifierResource($this->whenLoaded('category'))
//                    'data' => new AdminArticleCategoryResource($this->whenLoaded('category'))
                ],
                'timeline' => [
                    'links' => [
                        'self' => route('article.relationships.timeline', ['article' => $this->id]),
                        'related' => route('article.timeline', ['article' => $this->id])
                    ],
                    'data' => new AdminTimelineIdentifierResource($this->whenLoaded('timeline'))
//                    'data' => new AdminTimelineResource($this->whenLoaded('timeline'))
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
            AdminAuthorResource::collection($this->whenLoaded('authors')),
            AdminImageResource::collection($this->whenLoaded('images')),
            AdminTagResource::collection($this->whenLoaded('tags')),
            AdminBookmarkResource::collection($this->whenLoaded('bookmarks')),
        ];
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
