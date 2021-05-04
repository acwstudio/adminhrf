<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialResource;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
use App\Http\Resources\Admin\Document\AdminDocumentResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use App\Http\Resources\Admin\Tag\AdminTagResource;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminHighlightResource
 * @package App\Http\Resources\Admin
 */
class AdminHighlightableResource extends JsonResource
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
            'type' => 'highlightable',
            'attributes' => [
                'event_date' => $this->event_date,
                'highlight_id' => $this->highlight_id,
                'highlightable_type' => $this->highlightable_type,
                'highlightable_id' => $this->highlightable_id,
                'order' => $this->order,
                'is_additional' => $this->is_additional,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'highlightable' => [
                    $this->mergeWhen($this->highlightable_type === 'article', [
                        'data' => AdminArticleResource::make($this->highlightable)
                    ]),
                    $this->mergeWhen($this->highlightable_type === 'audiomaterial', [
                        'data' => AdminAudiomaterialResource::make($this->highlightable)
                    ]),
                    $this->mergeWhen($this->highlightable_type === 'videomaterial', [
                        'data' => AdminVideomaterialResource::make($this->highlightable)
                    ]),
                    $this->mergeWhen($this->highlightable_type === 'biography', [
                        'data' => AdminBiographyResource::make($this->highlightable)
                    ]),
                    $this->mergeWhen($this->highlightable_type === 'document', [
                        'data' => AdminDocumentResource::make($this->highlightable)
                    ]),
                ]
            ]
        ];
    }
}
