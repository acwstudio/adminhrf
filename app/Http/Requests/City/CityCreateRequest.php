<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CityCreateRequest
 * @package App\Http\Requests\City
 */
class CityCreateRequest extends FormRequest
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
            'data.type' => 'required|in:cities',
            'data.attributes' => 'required|array',
            'data.attributes.name' => 'string|required'
        ];
    }
}
