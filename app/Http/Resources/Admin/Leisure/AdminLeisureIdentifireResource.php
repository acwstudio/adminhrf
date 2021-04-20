<?php

namespace App\Http\Resources\Admin\Leisure;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminLeisureIdentifireResource
 * @package App\Http\Resources\Admin\Leisure
 */
class AdminLeisureIdentifireResource extends JsonResource
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
            'type' => 'leisures'
        ];
    }
}
