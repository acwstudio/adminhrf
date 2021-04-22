<?php

namespace App\Http\Requests\BookmarkGroup;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BookmarkGroupBookmarksUpdateRelationshipsRequest
 * @package App\Http\Requests\BookmarkGroup
 */
class BookmarkGroupBookmarksUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:bookmarks,id',
            'data.*.type' => 'required|in:bookmarks',
        ];
    }
}
