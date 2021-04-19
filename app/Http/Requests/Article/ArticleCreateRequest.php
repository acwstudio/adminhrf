<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleCreateRequest
 * @package App\Http\Requests\Article
 */
class ArticleCreateRequest extends FormRequest
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
            'data.type' => 'required|in:articles',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.user_id' => 'required|integer|exists:users,id',
            'data.attributes.category_id' => 'integer|exists:article_categories,id',
            'data.attributes.announce' => 'required|string',
            'data.attributes.body' => 'required|string',
            'data.attributes.show_in_rss' => 'required|boolean',
            'data.attributes.yatextid' => 'string',
            'data.attributes.active' => 'required|integer',
            'data.attributes.published_at' => 'required|string',
//            'data.attributes.commented' => 'required|integer',
            'data.attributes.biblio' => 'json',
//            'data.attributes.event_start_date' => 'string',
//            'data.attributes.event_end_date' => 'string',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'exists:tags,id',
            'data.relationships.authors.data.*.type' => 'present|in:authors',
            'data.relationships.authors.data.*.id' => 'exists:authors,id',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
//            'data.relationships.category.data.*.type' => 'present|in:category',
//            'data.relationships.category.data.*.id' => 'exists:article_categories,id',
        ];
    }
}
