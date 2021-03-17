<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorCreateRequest extends FormRequest
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
            'data.firstname' => 'required|string',
            'data.surname' => 'required|string',
            'data.patronymic' => 'required|string',
            'data.birth_date' => 'required|string',
            'data.announce' => 'required|string',
            'data.description' => 'required|string',
        ];
    }
}
