<?php

namespace App\Http\Resources\Admin\Question;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminQuestionsIdentifireResource
 * @package App\Http\Resources\Admin
 */
class AdminQuestionsIdentifireResource extends JsonResource
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
            'type' => 'questions'
        ];
    }
}
