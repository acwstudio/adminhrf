<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TestUpdateRequest
 * @package App\Http\Requests\Test
 */
class TestUpdateRequest extends FormRequest
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
            'data.attributes.title' => 'string',
            'data.attributes.description' => 'string',
            'data.attributes.is_active' => 'bool',
            'data.attributes.time' => 'integer',
            'data.attributes.created_at' => 'string',
            'data.attributes.updated_at' => 'string',
            'data.attributes.published_at' => 'string',
            'data.attributes.total_questions' => 'integer',
            'data.attributes.max_points' => 'integer',
            'data.attributes.has_points' => 'boolean',
            'data.attributes.is_reversable' => 'boolean',
            'data.attributes.is_ege' => 'boolean',

            'data.relationships.*' => 'present|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'integer|exists:images,id',
            'data.relationships.categories.data.*.type' => 'present|in:categories',
            'data.relationships.categories.data.*.id' => 'integer|exists:qcategories,id',
        ];
    }
}
