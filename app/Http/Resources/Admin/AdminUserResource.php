<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminUserResource
 * @package App\Http\Resources\Admin
 */
class AdminUserResource extends JsonResource
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
            'type' => 'users',
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
            ],
            'relationships' => [
                'role' => [
                    'link' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ],
                'results' => [
                    'link' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' => []
                ]
            ]
        ];
    }
}
