<?php

namespace App\Http\Requests\Timeline;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TimelineCreateRequest
 * @package App\Http\Requests\Timeline
 */
class TimelineCreateRequest extends FormRequest
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
            'data.type' => 'required|in:timelines',
            'data.attributes' => 'required|array',
            'data.attributes.date' => 'required|string',
            'data.attributes.timelinable_type' => 'required|string',
            'data.attributes.timelinable_id' => 'required|integer',
            'data.attributes.active' => 'required|boolean',
//            'data.attributes.created_at' => 'present|string',
//            'data.attributes.updated_at' => 'present|string',
        ];
    }
}
