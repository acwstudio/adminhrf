<?php

namespace App\Http\Resources\Admin\Answer;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminAnswerCollection
 * @package App\Http\Resources\Admin\Answer
 */
class AdminAnswerCollection extends ResourceCollection
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
