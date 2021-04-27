<?php

namespace App\Http\Resources\Admin\Audiofile;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminAudiofileCollection
 * @package App\Http\Resources\Admin\Audiofile
 */
class AdminAudiofileCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
