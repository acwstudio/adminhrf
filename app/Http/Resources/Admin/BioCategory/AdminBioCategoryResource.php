<?php

namespace App\Http\Resources\Admin\BioCategory;

use App\Http\Resources\Admin\Biography\AdminBiographiesIdentifireResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminBioCategoryResource
 * @package App\Http\Resources\Admin\BioCategory
 */
class AdminBioCategoryResource extends JsonResource
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
            'type' => 'biocategories',
            'slug' => $this->slug,
            'attributes' => [
                'title' => $this->title
            ],
            'relationships' => [
                'biographies' => [
                    'links' => [
                        'self' => '',
                        'related' => '',
                    ],
                    'data' => AdminBiographiesIdentifireResource::collection($this->whenLoaded('biographies'))
                ]
            ]
        ];
    }
}
