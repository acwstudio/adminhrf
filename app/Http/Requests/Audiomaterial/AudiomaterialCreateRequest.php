<?php

namespace App\Http\Requests\Audiomaterial;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AudiomaterialCreateRequest
 * @package App\Http\Requests\Audiomaterial
 */
class AudiomaterialCreateRequest extends FormRequest
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
            'data.type' => 'required|in:audiomaterials',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string|required',
            'data.attributes.paren_id' => 'integer',
            'data.attributes.description' => 'string|required',
            'data.attributes.path' => 'string|required',
            'data.attributes.position' => 'integer|required',
            'data.attributes.show_in_rss_apple' => 'boolean|required',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'integer|exists:tags,id',
//            'data.relationships.bookmarks.data.*.type' => 'present|in:bookmarks',
//            'data.relationships.bookmarks.data.*.id' => 'integer|exists:bookmarks,id',
//            'data.relationships.bookmarks.attributes.group_id' => 'present|integer',
            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'integer|exists:images,id',
            'data.relationships.highlights.data.*.type' => 'present|in:highlights',
            'data.relationships.highlights.data.*.id' => 'integer|exists:highlights,id',
            'data.relationships.audiofiles.data.*.id' => 'integer|exists:audiofiles,id',
            'data.relationships.audiofiles.data.*.type' => 'present|in:audiofiles',
        ];
    }
}
