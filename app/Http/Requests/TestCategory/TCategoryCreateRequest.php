<?php

namespace App\Http\Requests\TestCategory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TCategoryCreateRequest
 * @package App\Http\Requests\TestCategory
 */
class TCategoryCreateRequest extends FormRequest
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
            'data.type' => 'required|in:tcategories',
            'data.attributes' => 'required|array',
            'data.attributes.text' => 'required|string',
            'data.attributes.position' => 'required|integer',
        ];
    }
}
