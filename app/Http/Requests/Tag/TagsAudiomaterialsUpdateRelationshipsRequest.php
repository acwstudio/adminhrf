<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TagsAudiomaterialsUpdateRelationshipsRequest
 * @package App\Http\Requests\Tag
 */
class TagsAudiomaterialsUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:audiomaterials,id',
            'data.*.type' => 'required|in:audiomaterials',
        ];
    }
}
