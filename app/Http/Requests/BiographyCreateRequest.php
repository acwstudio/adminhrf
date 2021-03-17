<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'data.surname' => 'required|string',
            'data.firstname' => 'required|string',
            'data.patronymic' => 'required|string',
            'data.birth_date' => 'required',
            'data.death_date' => 'required',
            'data.announce' => 'required|string',
            'data.description' => 'required|string',
            'data.government_start' => 'required|integer',
            'data.government_end' => 'required|integer',
            'data.published_at' => 'required|string',
            'data.viewed' => 'required|integer',
            'data.biblio' => 'required|json',
            'data.active' => 'required|boolean',
        ];
    }
}
