<?php

namespace App\Http\Requests\BookmarkGroup;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BookmarkGroupCreateRequest
 * @package App\Http\Requests\BookmarkGroup
 */
class BookmarkGroupCreateRequest extends FormRequest
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
            'data.attributes.created_at' => 'present|string',
            'data.attributes.updated_at' => 'present|string',
            'data.attributes.user_id' => 'required|integer',
            'data.attributes.title' => 'required|string',
        ];
    }
}
