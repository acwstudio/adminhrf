<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
            'imageable_id' => 'required|integer',
            'imageable_type' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!array_key_exists($value, Relation::$morphMap) && $value !== 'common') {
                        $fail('Invalid ' . $attribute . '=' . $value);
                    }
                }
            ],
            'file' => 'required|image',
        ];
    }
}
