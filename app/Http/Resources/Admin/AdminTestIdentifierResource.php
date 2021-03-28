<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTestIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminTestIdentifierResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'tests'
        ];
    }
}
