<?php

namespace App\Http\Requests\TestMessage;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MessagesTestUpdateRelationshipsRequest
 * @package App\Http\Requests\TestMessage
 */
class MessagesTestUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'present|integer|exists:tests,id',
            'data.*.type' => 'present|in:tests'
        ];
    }
}
