<?php

namespace App\Http\Resources\Admin\Test;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTestsIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminTestsIdentifierResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
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
