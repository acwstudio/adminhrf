<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminMessageResource
 * @package App\Http\Resources\Admin
 */
class AdminMessageResource extends JsonResource
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
            'type' => 'messages',
            'attributes' => [
                'lowest_value' => $this->lowest_value,
                'text' => $this->text,
                'highest_value' => $this->highest_value,
                'title' => $this->title,
                'test_id' => $this->test_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'tests' => [
                    'links' => [
                        'self' => '',
                        'related' => ''
                    ],
                    'data' =>[]
                ]
            ]
        ];
    }
}
