<?php

namespace App\Http\Resources\Admin\Audiofile;

use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAudiofileResource
 * @package App\Http\Resources\Admin\Audiofile
 */
class AdminAudiofileResource extends JsonResource
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
            'type' => 'audiofiles',
            'attributes' => [
                'size' => $this->size,
                'path' => $this->path,
                'audiomaterial_id' => $this->audiomaterial_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'audiomaterials' => [
                    'links' => [
                        'self' => route('audiofile.relationships.audiomaterial', ['audiofile' => $this->id]),
                        'related' => route('audiofile.audiomaterial', ['audiofile' => $this->id])
                    ],
                    'data' => new AdminAudiomaterialResource($this->whenLoaded('audiomaterial'))
                ]
            ]
        ];
    }
}
