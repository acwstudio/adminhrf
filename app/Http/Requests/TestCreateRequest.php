<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TestCreateRequest
 * @package App\Http\Requests
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
            'data.attributes.created_at' => 'required|string',
            'data.attributes.updated_at' => 'required|string',
        ];
    }
}
