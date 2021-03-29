<?php

namespace App\Http\Requests\Biography;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BiographyCreateRequest
 * @package App\Http\Requests\Biography
 */
class BiographyCreateRequest extends FormRequest
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
            'data.type' => 'required|in:biographies',
            'data.attributes' => 'required|array',
            'data.attributes.surname' => 'required|string',
            'data.attributes.firstname' => 'required|string',
            'data.attributes.patronymic' => 'required|string',
            'data.attributes.birth_date' => 'required',
            'data.attributes.death_date' => 'required',
            'data.attributes.announce' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.government_start' => 'required|integer',
            'data.attributes.government_end' => 'required|integer',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.viewed' => 'required|integer',
            'data.attributes.biblio' => 'required|json',
            'data.attributes.active' => 'required|boolean',
        ];
    }
}
