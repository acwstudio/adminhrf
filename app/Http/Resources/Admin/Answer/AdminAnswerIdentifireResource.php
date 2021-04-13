<?php

namespace App\Http\Resources\Admin\Answer;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminAnswerIdentifireResource
 * @package App\Http\Resources\Admin
 */
class AdminAnswerIdentifireResource extends JsonResource
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
            'type' => 'answers'
        ];
    }
}
