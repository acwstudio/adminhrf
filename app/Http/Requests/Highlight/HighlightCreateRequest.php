<?php

namespace App\Http\Requests\Highlight;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HighlightCreateRequest
 * @package App\Http\Requests\Highlight
 */
class HighlightCreateRequest extends FormRequest
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
            'data.attributes.created_at' => 'present|string',
            'data.attributes.updated_at' => 'present|string',
            'data.attributes.title' => 'required|string',
            'data.attributes.type' => 'required|string',
            'data.attributes.announce' => 'required|string',
            'data.attributes.order' => 'required|integer',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.active' => 'required|boolean',
            'data.attributes.commented' => 'required|integer',
            'data.attributes.liked' => 'required|integer',
            'data.attributes.viewed' => 'required|integer',
        ];
    }
}
