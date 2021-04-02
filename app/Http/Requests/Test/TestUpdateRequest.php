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
        ];
    }
}
