<?php

namespace App\Http\Requests\Videomaterial;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VideomaterialCreateRequest
 * @package App\Http\Requests\Videomaterial
 */
class VideomaterialCreateRequest extends FormRequest
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
            'data.type' => 'required|in:videomaterials',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.announce' => 'present|string',
            'data.attributes.body' => 'present|string',
            'data.attributes.video_code' => 'required|string',
            'data.attributes.show_in_rss' => 'present|boolean',
            'data.attributes.show_in_main' => 'present|boolean',
            'data.attributes.active' => 'required|integer',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.type' => 'required|string',
            'data.attributes.close_commentation' => 'present|boolean',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'exists:tags,id',
            'data.relationships.authors.data.*.type' => 'present|in:authors',
            'data.relationships.authors.data.*.id' => 'exists:authors,id',
            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
