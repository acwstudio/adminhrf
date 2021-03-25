<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsCreateRequest
 * @package App\Http\Requests
 */
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
            'data' => 'required|array',
            'data.type' => 'required|in:news',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.yatextid' => 'required|string',
            'data.attributes.announce' => 'required|string',
            'data.attributes.listorder' => 'required|integer',
            'data.attributes.body' => 'required|string',
            'data.attributes.show_in_rss' => 'required|boolean',
            'data.attributes.status' => 'required|boolean',
            'data.attributes.show_in_main' => 'required|boolean',
            'data.attributes.show_in_afisha' => 'required|boolean',
            'data.attributes.close_commentation' => 'required|boolean',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.viewed' => 'required|integer',
        ];
    }
}
