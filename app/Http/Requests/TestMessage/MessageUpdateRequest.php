<?php

namespace App\Http\Requests\TestMessage;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MessageUpdateRequest
 * @package App\Http\Requests\TestMessage
 */
class MessageUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:messages',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.text' => 'string',
            'data.attributes.lowest_value' => 'integer',
            'data.attributes.highest_value' => 'integer',
            'data.attributes.test_id' => 'integer|exists:tests,id',

//            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'integer|exists:images,id',
        ];
    }
}
