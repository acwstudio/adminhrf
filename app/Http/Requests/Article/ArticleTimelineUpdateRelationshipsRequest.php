<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleTimelineUpdateRelationshipsRequest
 * @package App\Http\Requests\Article
 */
class ArticleTimelineUpdateRelationshipsRequest extends FormRequest
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
            'data.type' => 'required|in:timelines',
            'data.attributes.date' => 'string|required'
        ];
    }
}
