<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TagUpdateRequest
 * @package App\Http\Requests\Tag
 */
class TagUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:tags',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
        ];
    }
}
