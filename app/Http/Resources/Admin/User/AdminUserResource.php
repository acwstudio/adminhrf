<?php

namespace App\Http\Resources\Admin\User;

use App\Http\Resources\Admin\AdminCommentResource;
use App\Http\Resources\Admin\AdminImageResource;
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
                'email_verified_at' => $this->email_verified_at,
                'legacy' => $this->legacy,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'status' => $this->status
            ],
            'relationships' => [
                'socials' => [
                    'data' => []
                ],
                'role' => [
                    'data' => []
                ],
                'permissions' => [
                    'data' => []
                ],
                'comments' => [
                    'data' => AdminCommentResource::collection($this->whenLoaded('comments'))
                ],
                'image' => [
                    'data' => AdminImageResource::make($this->whenLoaded('image'))
                ]
            ]
        ];
    }
}
