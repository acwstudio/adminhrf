<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCreateRequest extends FormRequest
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
            'data.yatextid' => 'required|string',
            'data.announce' => 'required|string',
            'data.listorder' => 'required|integer',
            'data.body' => 'required|string',
            'data.show_in_rss' => 'required|boolean',
            'data.status' => 'required|boolean',
            'data.show_in_main' => 'required|boolean',
            'data.show_in_afisha' => 'required|boolean',
            'data.close_commentation' => 'required|boolean',
            'data.published_at' => 'required|string',
            'data.viewed' => 'required|integer',
        ];
    }
}
