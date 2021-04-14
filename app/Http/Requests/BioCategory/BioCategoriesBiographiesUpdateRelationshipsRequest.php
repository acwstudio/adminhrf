<?php

namespace App\Http\Requests\BioCategory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BioCategoriesBiographiesUpdateRelationshipsRequest
 * @package App\Http\Requests\BioCategory
 */
class BioCategoriesBiographiesUpdateRelationshipsRequest extends FormRequest
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
            'data' => 'present|array',
            'data.*.id' => 'required|integer|exists:biographies,id',
            'data.*.type' => 'required|in:biographies',
        ];
    }
}
