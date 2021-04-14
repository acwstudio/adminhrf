<?php

namespace App\Http\Requests\Biography;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BiographyTagsUpdateRelationshipsRequest
 * @package App\Http\Requests\Biography
 */
class BiographyTagsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|string|exists:tags,id',
            'data.*.type' => 'required|in:tags',
        ];
    }
}
