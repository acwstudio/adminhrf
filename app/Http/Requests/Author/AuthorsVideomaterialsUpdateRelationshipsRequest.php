<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AuthorsVideomaterialsUpdateRelationshipsRequest
 * @package App\Http\Requests\Author
 */
class AuthorsVideomaterialsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:videomaterials,id',
            'data.*.type' => 'required|in:videomaterials',
        ];
    }
}
