<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsUpdateRequest
 * @package App\Http\Requests\News
 */
class NewsUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:news',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.yatextid' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.listorder' => 'integer',
            'data.attributes.body' => 'string',
            'data.attributes.show_in_rss' => 'boolean',
            'data.attributes.status' => 'boolean',
            'data.attributes.show_in_main' => 'boolean',
            'data.attributes.show_in_afisha' => 'boolean',
            'data.attributes.close_commentation' => 'boolean',
            'data.attributes.published_at' => 'string',
            'data.attributes.viewed' => 'integer',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'present|exists:tags,id',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
