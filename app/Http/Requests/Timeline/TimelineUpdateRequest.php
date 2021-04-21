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
            'data.type' => 'required|in:timelines',
            'data.attributes' => 'required|array',
            'data.attributes.date' => 'required|string',
            'data.attributes.active' => 'required|boolean',
        ];
    }
}
