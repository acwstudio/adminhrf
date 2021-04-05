<?php

namespace App\Http\Requests\Timeline;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TimelineUpdateRequest
 * @package App\Http\Requests\Timeline
 */
class TimelineUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.id' => 'required|integer',
            'data.type' => 'required|in:timelines',
            'data.attributes' => 'required|array',
            'data.attributes.date' => 'string',
            'data.attributes.timelinable_type' => 'string',
            'data.attributes.timelinable_id' => 'integer',
            'data.attributes.active' => 'boolean',
            'data.attributes.created_at' => 'string',
            'data.attributes.updated_at' => 'string',
        ];
    }
}
