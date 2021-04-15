<?php

namespace App\Http\Requests\BioCategory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BioCategoryCreateRequest
 * @package App\Http\Requests\BioCategory
 */
class BioCategoryCreateRequest extends FormRequest
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
            'data.type' => 'required|in:biocategories',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
        ];
    }
}
