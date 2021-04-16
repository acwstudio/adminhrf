<?php

namespace App\Http\Requests\Videomaterial;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VideomaterialUpdateRequest
 * @package App\Http\Requests\Videomaterial
 */
class VideomaterialUpdateRequest extends FormRequest
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
            'data.id' => 'required|integer',
            'data.type' => 'required|in:videomaterials',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.body' => 'string',
            'data.attributes.video_code' => 'string',
            'data.attributes.show_in_rss' => 'boolean',
            'data.attributes.show_in_main' => 'boolean',
            'data.attributes.active' => 'integer',
            'data.attributes.published_at' => 'string',
            'data.attributes.type' => 'string',
            'data.attributes.close_commentation' => 'boolean',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'exists:tags,id',
            'data.relationships.authors.data.*.type' => 'present|in:authors',
            'data.relationships.authors.data.*.id' => 'exists:authors,id',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
