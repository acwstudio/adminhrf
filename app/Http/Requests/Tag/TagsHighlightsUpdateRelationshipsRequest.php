<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TagsHighlightsUpdateRelationshipsRequest
 * @package App\Http\Requests\Tag
 */
class TagsHighlightsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:highlights,id',
            'data.*.type' => 'required|in:highlights',
        ];
    }
}
