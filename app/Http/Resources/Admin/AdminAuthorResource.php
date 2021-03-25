<?php

namespace App\Http\Resources\Admin;

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this->whenLoaded('articles'));
        return [
            'id' => $this->id,
            'type' => 'authors',
            'slug' => $this->slug,
            'attributes' => [
                'firstname' => $this->firstname,
                'surname' => $this->surname,
                'patronymic' => $this->patronymic,
                'birth_date' => $this->birth_date,
                'announce' => $this->announce,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'articles' => [
                    'links' => [
                        'self' => route('authors.relationships.articles', ['author' => $this->id]),
                        'related' => route('authors.articles', ['author' => $this->id])
                    ],
                    'data' => AdminArticlesIdentifireResource::collection(
                        $this->articles
//                        $this->whenLoaded('articles')
                    ),
                ],
            ],
//            'articles' => $this->articles,
//            'articles' => AdminArticleResource::collection($this->whenLoaded('articles')),
        ];
    }
}
