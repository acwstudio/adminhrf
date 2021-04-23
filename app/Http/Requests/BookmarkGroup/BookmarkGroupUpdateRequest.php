<?php

namespace App\Http\Requests\BookmarkGroup;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BookmarkGroupUpdateRequest
 * @package App\Http\Requests\BookmarkGroup
 */
class BookmarkGroupUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:bookmarkgroups',
            'data.attributes' => 'required|array',
            'data.attributes.user_id' => 'integer|exists:users,id',
            'data.attributes.title' => 'string',
        ];
    }
}
