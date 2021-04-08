<?php

namespace App\Http\Requests\TestResult;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResultsTestRelationshipsUpdateRequest
 * @package App\Http\Requests\TestResult
 */
class ResultsTestRelationshipsUpdateRequest extends FormRequest
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
            'data' => 'present|array',
            'data.*.id' => 'present|integer',
            'data.*.type' => 'present|in:tests'
        ];
    }
}
