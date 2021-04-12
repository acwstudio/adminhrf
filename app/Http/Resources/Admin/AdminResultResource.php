<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\Test\AdminTestsIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminResultResource
 * @package App\Http\Resources\Admin
 */
class AdminResultResource extends JsonResource
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
            'type' => 'results',
            'attributes' => [
                'user_id' => $this->user_id,
                'test_id' => $this->test_id,
                'is_closed' => $this->is_closed,
                'time_passed' => $this->time_passed,
                'value' => $this->value,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'test' => [
                    'links' => [
                        'self' => route('results.relationships.test', ['result' => $this->id]),
                        'related' => route('results.test', ['result' => $this->id])
                    ],
                    'data' => new AdminTestsIdentifierResource($this->whenLoaded('test'))
                ],
                'user' => [
                    'links' => [
                        'self' => route('results.relationships.user', ['result' => $this->id]),
                        'related' => route('results.user', ['result' => $this->id])
                    ],
                    'data' => new AdminUserIdentifierResource($this->whenLoaded('user'))
                ]
            ]
        ];
    }
}
