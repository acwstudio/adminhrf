<?php

namespace App\Http\Resources\Admin\Question;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminQuestionCollection
 * @package App\Http\Resources\Admin\Question
 */
class AdminQuestionCollection extends ResourceCollection
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
