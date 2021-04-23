<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TestCreateRequest
 * @package App\Http\Requests\Test
 */
class TestCreateRequest extends FormRequest
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
            'data.type' => 'required|in:tests',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.is_active' => 'required|bool',
            'data.attributes.time' => 'required|integer',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.total_questions' => 'required|integer',
            'data.attributes.max_points' => 'required|integer',
            'data.attributes.has_points' => 'required|boolean',
            'data.attributes.is_reversable' => 'required|boolean',
            'data.attributes.is_ege' => 'required|boolean',

            'data.relationships.*' => 'present|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'integer|exists:images,id',
            'data.relationships.categories.data.*.type' => 'present|in:categories',
            'data.relationships.categories.data.*.id' => 'integer|exists:qcategories,id',
        ];
    }
}
