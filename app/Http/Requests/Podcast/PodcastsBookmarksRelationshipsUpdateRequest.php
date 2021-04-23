<?php

namespace App\Http\Requests\Podcast;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PodcastsBookmarksRelationshipsUpdateRequest
 * @package App\Http\Requests\Podcast
 */
class PodcastsBookmarksRelationshipsUpdateRequest extends FormRequest
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
            'data.*.id' => 'present|integer|exists:bookmarks,id',
            'data.*.type' => 'present|in:bookmarks'
        ];
    }
}
