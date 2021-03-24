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
     * @param  \Illuminate\Http\Request  $request
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
                ]
            ],

//            'tags' => AdminTagResource::collection($this->whenLoaded('tags')),
//            'authors' => AdminAuthorResource::collection($this->whenLoaded('authors')),
//            'images' => $this->images,
//            'comments' => $this->comments,
//            'bookmarks' => $this->bookmarks,
//            'timeline' => $this->timeline,
        ];
    }

    /**
     * @return array
     */
//    private function relations()
//    {
//        return [
//            AdminAuthorResource::collection($this->whenLoaded('authors'))
//        ];
//    }

    /**
     * @param $request
     * @return \Illuminate\Support\Collection
     */
//    public function included($request)
//    {
//        return collect($this->relations())
//            ->filter(function ($resource) {
//                return $resource->collection !== null;
//            })
//            ->flatMap(function ($resource) use ($request) {
//                /** @var AdminAuthorResource $resource */
//                return $resource->toArray($request);
//            });
//    }

    /**
     * Get any additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
//    public function with($request)
//    {
//        $with = [];
//
//        if ($this->included($request)->isNotEmpty()) {
//            $with['included'] = $this->included($request);
//        }
//
//        return $with;
//    }
}
