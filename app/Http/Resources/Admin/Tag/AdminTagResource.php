<?php

namespace App\Http\Resources\Admin\Tag;

use App\Http\Resources\Admin\AdminHighlightResource;
use App\Http\Resources\Admin\AdminHighlightsIdentifierResource;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialIdentifierResource;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialResource;
use App\Http\Resources\Admin\Biography\AdminBiographiesIdentifireResource;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
use App\Http\Resources\Admin\Document\AdminDocumentResource;
use App\Http\Resources\Admin\Document\AdminDocumentsIdentifireResource;
use App\Http\Resources\Admin\News\AdminNewsIdentifireResource;
use App\Http\Resources\Admin\News\AdminNewsResource;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialIdentifierResource;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTagResource
 * @package App\Http\Resources\Admin
 */
class AdminTagResource extends JsonResource
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
            'type' => 'tags',
            'slug' => $this->slug,
            'attributes' => [
                'title' => $this->title,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'articles' => [
                    'links' => [
                        'self' => route('tags.relationships.articles', ['tag' => $this->id]),
                        'related' => route('tags.articles', ['tag' => $this->id])
                    ],
                    'data' => AdminArticleResource::collection($this->whenLoaded('articles'))
                ],
                'documents' => [
                    'links' => [
                        'self' => route('tags.relationships.documents', ['tag' => $this->id]),
                        'related' => route('tags.documents', ['tag' => $this->id])
                    ],
                    'data' => AdminDocumentResource::collection($this->whenLoaded('documents'))
                ],
                'news' => [
                    'links' => [
                        'self' => route('tags.relationships.news', ['tag' => $this->id]),
                        'related' => route('tags.news', ['tag' => $this->id])
                    ],
                    'data' => AdminNewsResource::collection($this->whenLoaded('news'))
                ],
                'biographies' => [
                    'links' => [
                        'self' => route('tags.relationships.biographies', ['tag' => $this->id]),
                        'related' => route('tags.biographies', ['tag' => $this->id])
                    ],
                    'data' => AdminBiographyResource::collection($this->whenLoaded('biographies'))
                ],
                'videomaterials' => [
                    'links' => [
                        'self' => route('tags.relationships.videomaterials', ['tag' => $this->id]),
                        'related' => route('tags.videomaterials', ['tag' => $this->id])
                    ],
                    'data' => AdminVideomaterialResource::collection(
                        $this->whenLoaded('videomaterials')
                    )
                ],
                'audiomaterials' => [
                    'links' => [
                        'self' => route('tags.relationships.audiomaterials', ['tag' => $this->id]),
                        'related' => route('tags.audiomaterials', ['tag' => $this->id])
                    ],
                    'data' => AdminAudiomaterialResource::collection(
                        $this->whenLoaded('audiomaterials')
                    )
                ],
                'highlights' => [
                    'links' => [
                        'self' => route('tags.relationships.highlights', ['tag' => $this->id]),
                        'related' => route('tags.highlights', ['tag' => $this->id])
                    ],
                    'data' => AdminHighlightResource::collection(
                        $this->whenLoaded('highlights')
                    )
                ]
            ]
        ];
    }
}
