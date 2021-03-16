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
            'data' => 'required|array',
            'data.model_type' => 'required|in:articles|string',
            'data.title' => 'required|string',
            'data.announce' => 'required|string',
            'data.body' => 'required|string',
            'data.show_in_rss' => 'required|boolean',
            'data.yatextid' => 'required|string',
            'data.active' => 'required|boolean',
            'data.published_at' => 'required|string'
        ];
    }
}
