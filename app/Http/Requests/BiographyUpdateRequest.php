<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiographyUpdateRequest extends FormRequest
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
            'data.surname' => 'string',
            'data.firstname' => 'string',
            'data.patronymic' => 'string',
            'data.birth_date' => 'string',
            'data.death_date' => 'string',
            'data.announce' => 'string',
            'data.description' => 'string',
            'data.government_start' => 'integer',
            'data.government_end' => 'integer',
            'data.published_at' => 'string',
            'data.viewed' => 'integer',
            'data.biblio' => 'json',
            'data.active' => 'boolean',
        ];
    }
}
