<?php

namespace App\Http\Requests\ArticleCategory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleCategoryArticlesRelationshipsUpdateRequest
 * @package App\Http\Requests\ArticleCategory
 */
class ArticleCategoryArticlesRelationshipsUpdateRequest extends FormRequest
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
            'data.*.id' => 'present|integer',
            'data.*.type' => 'present|in:articles'
        ];
    }
}
