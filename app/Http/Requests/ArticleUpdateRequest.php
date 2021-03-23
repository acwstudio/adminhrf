<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'data.id' => 'required|string',
            'data.type' => 'required|in:articles',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.body' => 'string',
            'data.attributes.show_in_rss' => 'boolean',
            'data.attributes.yatextid' => 'string',
            'data.attributes.active' => 'boolean',
            'data.attributes.published_at' => 'string',
            'data.attributes.viewed' => 'integer',
            'data.attributes.liked' => 'integer',
            'data.attributes.commented' => 'string',
            'data.attributes.biblio' => 'json',
            'data.attributes.event_start_date' => 'string',
            'data.event_end_date' => 'string',
        ];
    }
}
