<?php

namespace App\Http\Requests\Bookmark;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BookmarkCreateRequest
 * @package App\Http\Requests\Bookmark
 */
class BookmarkCreateRequest extends FormRequest
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
            'data.type' => 'required|in:bookmarks',
            'data.attributes' => 'required|array',
            'data.attributes.group_id' => 'required|integer',
            'data.attributes.bookmarkable_type' => 'required|string',
            'data.attributes.bookmarkable_id' => 'required|integer',
//            'data.attributes.created_at' => 'present|string',
        ];
    }
}
