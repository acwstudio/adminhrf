<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ImageUpdateRequest
 * @package App\Http\Requests
 */
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
            'data' => 'required|array',
            'data.id' => 'required|string',
            'data.type' => 'required|in:images',
            'data.attributes' => 'required|array',
            'data.attributes.path' => 'string',
            'data.attributes.name' => 'string',
            'data.attributes.ext' => 'string',
            'data.attributes.alt' => 'string',
            'data.attributes.order' => 'integer',
            'data.attributes.imageable_id' => 'integer',
            'data.attributes.imageable_type' => 'string',
            'data.attributes.flags' => 'integer',
        ];
    }
}
