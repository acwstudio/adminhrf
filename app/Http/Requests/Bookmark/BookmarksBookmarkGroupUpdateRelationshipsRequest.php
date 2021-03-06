<?php

namespace App\Http\Requests\Bookmark;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BookmarksBookmarkGroupUpdateRelationshipsRequest
 * @package App\Http\Requests\Bookmark
 */
class BookmarksBookmarkGroupUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:bookmark_groups,id',
            'data.*.type' => 'required|in:bookmarkgroups',
        ];
    }
}
