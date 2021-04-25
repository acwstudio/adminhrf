<?php

namespace App\Http\Requests\Audiomaterial;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AudiomaterialBookmarksUpdateRelationshipsRequest
 * @package App\Http\Requests\Audiomaterial
 */
class AudiomaterialBookmarksUpdateRelationshipsRequest extends FormRequest
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
            'data.*.type' => 'required|in:bookmarks'
        ];
    }
}
