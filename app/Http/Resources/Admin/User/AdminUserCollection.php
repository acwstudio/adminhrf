<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class AdminUserCollection
 * @package App\Http\Resources\Admin
 */
class AdminUserCollection extends ResourceCollection
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
            'data' => $this->collection
        ];
    }
}
