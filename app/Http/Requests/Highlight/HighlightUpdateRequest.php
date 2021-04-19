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
//            'data.attributes.created_at' => 'string',
//            'data.attributes.updated_at' => 'string',
            'data.attributes.title' => 'string',
            'data.attributes.type' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.order' => 'integer',
            'data.attributes.published_at' => 'string',
        ];
    }
}
