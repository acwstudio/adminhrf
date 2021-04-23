<?php

namespace App\Http\Requests\Podcast;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PodcastUpdateRequest
 * @package App\Http\Requests\Podcast
 */
class PodcastUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:podcasts',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.description' => 'string',
            'data.attributes.iframe' => 'string',
            'data.attributes.order' => 'integer',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'integer|exists:tags,id',
            'data.relationships.bookmarks.data.*.type' => 'present|in:bookmarks',
            'data.relationships.bookmarks.data.*.id' => 'integer|exists:bookmarks,id',
            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'integer|exists:images,id',
        ];
    }
}
