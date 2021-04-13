<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticlesArticleCategoryUpdateRelationshipsRequest
 * @package App\Http\Requests\Article
 */
class ArticlesArticleCategoryUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:article_categories,id',
            'data.*.type' => 'required|in:articlecategories'
        ];
    }
}
