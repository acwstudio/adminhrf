<?php

namespace App\Http\Requests\TestCategory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TCategoriesTestsUpdateRelationshipsRequest
 * @package App\Http\Requests\TestCategory
 */
class TCategoriesTestsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:tests,id',
            'data.*.type' => 'required|in:tests'
        ];
    }
}
