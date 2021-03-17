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
            'data.title' => 'string',
            'data.announce' => 'string',
            'data.body' => 'string',
            'data.show_in_rss' => 'boolean',
            'data.yatextid' => 'string',
            'data.active' => 'boolean',
            'data.published_at' => 'string',
            'data.viewed' => 'integer',
            'data.liked' => 'integer',
            'data.commented' => 'integer',
            'data.biblio' => 'array',
            'data.model_type' => 'string',
            'data.event_start_date' => 'string',
            'data.event_end_date' => 'string',
        ];
    }
}
