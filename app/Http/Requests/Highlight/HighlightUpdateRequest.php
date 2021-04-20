<?php

namespace App\Http\Requests\Highlight;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HighlightUpdateRequest
 * @package App\Http\Requests\Highlight
 */
class HighlightUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:highlights',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.announce' => 'required|string',
            'data.attributes.order' => 'required|integer',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.active' => 'required|boolean',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'exists:tags,id',
            'data.relationships.images.data' => 'required|array',
            'data.relationships.highlightables.data.*.type' => 'present',
            'data.relationships.highlightables.data.*.id' => 'present',
            'data.relationships.highlightables.data.*.is_additional' => 'sometimes|boolean',
        ];
    }
}
