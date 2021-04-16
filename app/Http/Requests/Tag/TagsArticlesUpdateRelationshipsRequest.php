<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TagsArticlesUpdateRelationshipsRequest
 * @package App\Http\Requests\Tag
 */
class TagsArticlesUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:articles,id',
            'data.*.type' => 'required|in:articles',
        ];
    }
}
