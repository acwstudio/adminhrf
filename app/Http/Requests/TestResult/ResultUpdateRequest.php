<?php

namespace App\Http\Requests\TestResult;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResultUpdateRequest
 * @package App\Http\Requests\TestResult
 */
class ResultUpdateRequest extends FormRequest
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
            'data.id' => 'required|string',
            'data.type' => 'required|in:results',
            'data.attributes' => 'required|array',
            'data.attributes.user_id' => 'integer',
            'data.attributes.test_id' => 'integer',
//            'data.attributes.is_closed' => 'boolean',
//            'data.attributes.time_passed' => 'integer',
            'data.attributes.value' => 'integer',
        ];
    }
}
