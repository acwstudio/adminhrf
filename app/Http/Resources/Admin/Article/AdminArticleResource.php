<?php

namespace App\Http\Resources\Admin\Article;

use App\Http\Resources\Admin\AdminBookmarksIdentifierResource;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\AdminTimelineIdentifierResource;
use App\Http\Resources\Admin\Author\AdminAuthorsIdentifireResource;
use App\Http\Resources\Admin\AdminBookmarkResource;
use App\Http\Resources\Admin\AdminCommentResource;
use App\Http\Resources\Admin\AdminImageResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryIdentifierResource;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'type' => 'articles',
            'slug' => $this->slug,
            'attributes' => [
                'user_id' => $this->user_id,
                'category_id' => $this->category_id,
                'title' => $this->title,
                'announce' => $this->announce,
                'body' => $this->body,
                'show_in_rss' => $this->show_in_rss,
                'yatextid' => $this->yatextid,
                'active' => $this->active,
                'published_at' => $this->published_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'viewed' => $this->viewed,
                'liked' => $this->liked,
                'commented' => $this->commented,
                'biblio' => $this->biblio,
                'event_date' => $this->event_date,
                'event_start_date' => $this->event_start_date,
                'event_end_date' => $this->event_end_date,
            ],
            'relationships' => [
                'authors' => [
                    'links' => [
                        'self' => route('articles.relationships.authors', ['article' => $this->id]),
                        'related' => route('articles.authors', ['article' => $this->id])
                    ],
                    'data' => AdminAuthorsIdentifireResource::collection($this->whenLoaded('authors'))
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
//                    'data' => AdminImageResource::collection($this->whenLoaded('images'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('article.relationships.bookmarks', ['article' => $this->id]),
                        'related' => route('article.bookmarks', ['article' => $this->id])
                    ],
                    'data' => AdminBookmarksIdentifierResource::collection($this->whenLoaded('bookmarks'))
//                    'data' => AdminBookmarkResource::collection($this->whenLoaded('bookmarks'))
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

//    private function relations()
//    {
//        return [
//            new AdminAuthorCollection($this->whenLoaded('authors')),
//            new AdminTagCollection($this->whenLoaded('tags'))
//        ];
//    }

//    public function with($request)
//    {
//        return [
//            'included' => $this->relations(),

//        'included' => collect($this->relations())
//            ->flatMap(function ($resource) use($request){
//                return $resource->toArray($request);
//            })
//        ];
//            'included' => collect($this->relations())
//                ->filter(function ($resource) {
//                    return $resource->collection !== null;
//                })
//                ->flatMap(function ($resource) use ($request) {
//                    return $resource->toArray($request);
//                })
//        ];
//    }
}
