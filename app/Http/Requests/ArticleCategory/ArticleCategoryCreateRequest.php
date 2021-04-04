<?php

namespace App\Http\Requests\ArticleCategory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleCategoryCreateRequest
 * @package App\Http\Requests\ArticleCategory
 */
class ArticleCategoryCreateRequest extends FormRequest
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
            'data.type' => 'required|in:articlecategories',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.created_at' => 'present|string',
            'data.attributes.updated_at' => 'present|string',
        ];
    }
}
