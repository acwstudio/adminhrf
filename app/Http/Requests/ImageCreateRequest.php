<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ImageCreateRequest
 * @package App\Http\Requests
 */
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
            'image' => 'required',
            'imageable_type' => 'required|string'
//            'data' => 'required|array',
//            'data.type' => 'required|in:images',
//            'data.attributes' => 'required|array',
//            'data.attributes.path' => 'required|string',
//            'data.attributes.name' => 'required|string',
//            'data.attributes.ext' => 'required|string',
//            'data.attributes.alt' => 'required|string',
//            'data.attributes.order' => 'required|integer',
//            'data.attributes.imageable_id' => 'required|integer',
//            'data.attributes.imageable_type' => 'required|string',
//            'data.attributes.flags' => 'required|integer',
        ];
    }
}
