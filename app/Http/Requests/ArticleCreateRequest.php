<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'data.title' => 'required|string',
            'data.announce' => 'required|string',
            'data.body' => 'required|string',
            'data.show_in_rss' => 'required|boolean',
            'data.yatextid' => 'required|string',
            'data.active' => 'required|boolean',
            'data.published_at' => 'required|string',
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
