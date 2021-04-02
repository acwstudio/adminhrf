<?php

namespace App\Http\Requests\Bookmark;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BookmarkUpdateRequest
 * @package App\Http\Requests\Bookmark
 */
class BookmarkUpdateRequest extends FormRequest
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
            'type' => 'required|in:bookmarks',
            'data.attributes' => 'required|array',
            'data.attributes.group_id' => 'integer',
            'data.attributes.bookmarkable_type' => 'string',
            'data.attributes.bookmarkable_id' => 'integer',
            'data.attributes.created_at' => 'string',
        ];
    }
}
