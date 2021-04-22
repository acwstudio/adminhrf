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
            'data.attributes.user_id' => 'integer|exists:users,id',
            'data.attributes.test_id' => 'integer|exists:tests,id',
            'data.attributes.value' => 'integer',
        ];
    }
}
