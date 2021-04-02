<?php

namespace App\Http\Requests\Highlight;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HighlightsTagsUpdateRelationshipsRequest
 * @package App\Http\Requests\Highlight
 */
class HighlightsTagsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|string',
            'data.*.type' => 'required|in:tags',
        ];
    }
}
