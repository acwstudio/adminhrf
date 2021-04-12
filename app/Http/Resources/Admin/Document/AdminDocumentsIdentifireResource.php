<?php

namespace App\Http\Resources\Admin\Document;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminDocumentsIdentifireResource
 * @package App\Http\Resources\Admin
 */
class AdminDocumentsIdentifireResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => 'documents'
        ];
    }
}
