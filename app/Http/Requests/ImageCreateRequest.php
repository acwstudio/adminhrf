<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageCreateRequest extends FormRequest
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
            'data.path' => 'required|string',
            'data.name' => 'required|string',
            'data.ext' => 'required|string',
            'data.alt' => 'required|string',
            'data.order' => 'required|integer',
            'data.imageable_id' => 'required|integer',
            'data.imageable_type' => 'required|string',
            'data.flags' => 'required|integer',
        ];
    }
}
