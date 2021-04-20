<?php

namespace App\Http\Requests\Leisure;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LeisureCreateRequest
 * @package App\Http\Requests\Leisure
 */
class LeisureCreateRequest extends FormRequest
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
            'data.type' => 'required|in:leisures',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string|required',
            'data.attributes.active' => 'boolean',
            'data.attributes.count' => 'integer',
        ];
    }
}
