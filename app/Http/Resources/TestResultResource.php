<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
        return [
            'model_type' => 'test_result',
            'id' => $this->id,
            'test_id' => $this->test_id,
            'is_closed'=> $this->is_closed,
            'time_passed'=> $this->time_passed,
            'value'=> $this->value,
            'updated_at'=> $this->updated_at
        ];
    }
}
