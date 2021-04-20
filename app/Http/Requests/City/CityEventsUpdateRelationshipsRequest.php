<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CityEventsUpdateRelationshipsRequest
 * @package App\Http\Requests\City
 */
class CityEventsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:cities,id',
            'data.*.type' => 'required|in:cities',
        ];
    }
}
