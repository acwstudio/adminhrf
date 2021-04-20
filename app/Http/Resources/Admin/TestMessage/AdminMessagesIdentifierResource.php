<?php

namespace App\Http\Resources\Admin\TestMessage;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminMessagesIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminMessagesIdentifierResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => 'messages'
        ];
    }
}
