<?php

namespace App\Http\Requests\Highlight;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HihglightImagesUpdateRelationshipsRequest
 * @package App\Http\Requests\Highlight
 */
class HihglightImagesUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|string',
            'data.*.type' => 'required|in:images',
        ];
    }
}
