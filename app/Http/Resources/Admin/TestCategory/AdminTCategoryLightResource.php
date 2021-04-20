<?php

namespace App\Http\Resources\Admin\TestCategory;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdminTCategoryLightResource
 * @package App\Http\Resources\Admin
 */
class AdminTCategoryLightResource extends JsonResource
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
            'type' => 'tcategories',
            'title' => $this->text
        ];
    }
}
