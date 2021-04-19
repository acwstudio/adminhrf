<?php

namespace App\Http\Requests\TestResult;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResultCreateRequest
 * @package App\Http\Requests\TestResult
 */
class ResultCreateRequest extends FormRequest
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
            'data.type' => 'required|in:results',
            'data.attributes' => 'required|array',
            'data.attributes.user_id' => 'required|integer',
            'data.attributes.test_id' => 'required|integer',
//            'data.attributes.is_closed' => 'required|boolean',
//            'data.attributes.time_passed' => 'required|integer',
            'data.attributes.value' => 'required|integer',
        ];
    }
}
