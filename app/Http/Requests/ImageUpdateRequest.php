<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
            'data.path' => 'string',
            'data.name' => 'string',
            'data.ext' => 'string',
            'data.alt' => 'string',
            'data.order' => 'integer',
            'data.imageable_id' => 'integer',
            'data.imageable_type' => 'string',
            'data.flags' => 'integer'
        ];
    }
}
