<?php

namespace App\Http\Resources\Admin;

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
                'user_id' => null,
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
//                    'data' => AdminAuthorsIdentifireResource::collection($this->whenLoaded('authors'))
                    'data' => AdminAuthorResource::collection($this->whenLoaded('authors'))
                ],
                'comments' => [
                    'links' => [
                        'self' => route('article.relationships.comments', ['article' => $this->id]),
                        'related' => route('article.comments', ['article' => $this->id])
                    ],
//                    'data' => AdminCommentsIdentifierResource::collection($this->whenLoaded('comments'))
                    'data' => AdminCommentResource::collection($this->whenLoaded('comments'))
                ],
                'tags' => [
                    'links' => [
                        'self' => route('articles.relationships.tags', ['article' => $this->id]),
                        'related' => route('articles.tags', ['article' => $this->id])
                    ],
//                    'data' => AdminTagsIdentifierResource::collection($this->whenLoaded('tags'))
                    'data' => AdminTagResource::collection($this->whenLoaded('tags'))
                ],
                'images' => [
                    'links' => [
                        'self' => route('article.relationships.images', ['article' => $this->id]),
                        'related' => route('article.images', ['article' => $this->id])
                    ],
//                    'data' => AdminImagesIdentifierResource::collection($this->whenLoaded('images'))
                    'data' => AdminImageResource::collection($this->whenLoaded('images'))
                ],
                'bookmarks' => [
                    'links' => [
                        'self' => route('article.relationships.bookmarks', ['article' => $this->id]),
                        'related' => route('article.bookmarks', ['article' => $this->id])
                    ],
//                    'data' => AdminBookmarksIdentifierResource::collection($this->whenLoaded('bookmarks'))
                    'data' => AdminBookmarkResource::collection($this->whenLoaded('bookmarks'))
                ],
                'category' => [
                    'links' => [
                        'self' => route('articles.relationships.article-category', ['article' => $this->id]),
                        'related' => route('articles.article-category', ['article' => $this->id])
                    ],
//                    'data' => new AdminArticleCategoryIdentifierResource($this->whenLoaded('category'))
                    'data' => new AdminArticleCategoryResource($this->whenLoaded('category'))
                ],
                'timeline' => [
                    'links' => [
                        'self' => route('article.relationships.timeline', ['article' => $this->id]),
                        'related' => route('article.timeline', ['article' => $this->id])
                    ],
//                    'data' => new AdminArticleCategoryIdentifierResource($this->whenLoaded('category'))
                    'data' => new AdminTimelineResource($this->whenLoaded('timeline'))
                ]
            ],
//            'timeline' => $this->timeline,
        ];
    }

//    private function relations()
//    {
//        return [
//            AdminAuthorResource::collection($this->whenLoaded('authors')),
//            AdminTagResource::collection($this->whenLoaded('tags'))
//        ];
//    }

//    public function with($request)
//    {
//        return [

//            'included' => collect($this->relations())->flatMap(function ($value) use($request) {
    /** @var \Illuminate\Http\Resources\Json\ResourceCollection $value */
//                return $value->toArray($request);
//                return $value;
//            }),
//            'included' => $this->relations()
//        ];
//    }
}
