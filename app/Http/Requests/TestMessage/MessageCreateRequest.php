<?php

namespace App\Http\Requests\TestMessage;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MessageCreateRequest
 * @package App\Http\Requests\TestMessage
 */
class MessageCreateRequest extends FormRequest
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
            'data.attributes.title' => 'required|string',
            'data.attributes.text' => 'required|string',
            'data.attributes.lowest_value' => 'required|integer',
            'data.attributes.highest_value' => 'required|integer',
            'data.attributes.test_id' => 'required|integer',
        ];
    }
}
