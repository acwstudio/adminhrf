<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticlesAuthorsUpdateRelationshipsRequest
 * @package App\Http\Requests\Article
 */
class ArticlesAuthorsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:authors,id',
            'data.*.type' => 'required|in:authors',
        ];
    }
}
