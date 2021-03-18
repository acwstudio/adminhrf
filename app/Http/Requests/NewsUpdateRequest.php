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
        return false;
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
            'data.yatextid' => 'string',
            'data.announce' => 'string',
            'data.listorder' => 'integer',
            'data.body' => 'string',
            'data.show_in_rss' => 'boolean',
            'data.status' => 'boolean',
            'data.show_in_main' => 'boolean',
            'data.show_in_afisha' => 'boolean',
            'data.close_commentation' => 'boolean',
            'data.published_at' => 'string',
            'data.viewed' => 'integer',
        ];
    }
}
