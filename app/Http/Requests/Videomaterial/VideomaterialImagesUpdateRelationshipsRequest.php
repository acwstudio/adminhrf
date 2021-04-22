<?php

namespace App\Http\Requests\Videomaterial;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VideomaterialImagesUpdateRelationshipsRequest
 * @package App\Http\Requests\Videomaterial
 */
class VideomaterialImagesUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:images,id',
            'data.*.type' => 'required|in:images',
        ];
    }
}
