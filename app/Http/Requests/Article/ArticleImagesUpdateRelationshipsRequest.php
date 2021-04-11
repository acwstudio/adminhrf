<?php

namespace App\Http\Requests\Article;

use App\Rules\EqualImageableType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class ArticleImagesUpdateRelationshipsRequest
 * @package App\Http\Requests\Article
 */
class ArticleImagesUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:images,id',
            'data.*.type' => 'required|in:images',
        ];
    }
}
