<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleCreateRequest
 * @package App\Http\Requests
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
            'data.attributes.announce' => 'required|string',
            'data.attributes.body' => 'required|string',
            'data.attributes.show_in_rss' => 'required|boolean',
            'data.attributes.yatextid' => 'required|string',
            'data.attributes.active' => 'required|boolean',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.viewed' => 'integer',
            'data.attributes.liked' => 'integer',
            'data.attributes.commented' => 'string',
            'data.attributes.biblio' => 'json',
            'data.attributes.event_start_date' => 'string',
            'data.event_end_date' => 'string',
        ];
    }
}
