<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class UserUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:users',
            'data.attributes' => 'required|array',
            'data.attributes.name' => ['sometimes', 'required', 'string', 'max:255'],
            'data.attributes.password' => ['sometimes', 'required', 'string', new Password],
            'data.attributes.role_id' => ['nullable', 'exists:roles,id'],
            'data.attributes.status' => [
                'nullable',
                Rule::in(User::$statuses)
            ],

            'data.relationships.*' => 'present|array',
            'data.relationships.permissions.data.*.type' => 'present|in:permissions',
            'data.relationships.permissions.data.*.id' => 'integer|exists:permissions,id',

        ];
    }

}
