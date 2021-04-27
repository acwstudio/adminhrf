<?php

namespace App\Http\Resources\Admin\Audiofile;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAudiofileIdentifiersResource
 * @package App\Http\Resources\Admin\Audiofile
 */
class AdminAudiofileIdentifiersResource extends JsonResource
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
            'type' => 'audiofiles'
        ];
    }
}
