<?php

namespace App\Http\Resources\Admin\TestResult;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminResultsIdentifierResource
 * @package App\Http\Resources\Admin
 */
class AdminResultsIdentifierResource extends JsonResource
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
            'type' => 'results'
        ];
    }
}
