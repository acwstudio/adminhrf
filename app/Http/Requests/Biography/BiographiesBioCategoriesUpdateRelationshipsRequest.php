<?php

namespace App\Http\Requests\Biography;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BiographiesBioCategoriesUpdateRelationshipsRequest
 * @package App\Http\Requests\Biography
 */
class BiographiesBioCategoriesUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:biocategories,id',
            'data.*.type' => 'required|in:biocategories',
        ];
    }
}
