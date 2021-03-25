<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:news',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.yatextid' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.listorder' => 'integer',
            'data.attributes.body' => 'string',
            'data.attributes.show_in_rss' => 'boolean',
            'data.attributes.status' => 'boolean',
            'data.attributes.show_in_main' => 'boolean',
            'data.attributes.show_in_afisha' => 'boolean',
            'data.attributes.close_commentation' => 'boolean',
            'data.attributes.published_at' => 'string',
            'data.attributes.viewed' => 'integer',
        ];
    }
}
