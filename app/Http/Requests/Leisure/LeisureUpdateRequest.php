<?php

namespace App\Http\Requests\Leisure;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LeisureUpdateRequest
 * @package App\Http\Requests\Leisure
 */
class LeisureUpdateRequest extends FormRequest
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
            'data.attributes.title' => 'string',
            'data.attributes.active' => 'boolean',
            'data.attributes.count' => 'integer',
        ];
    }
}
