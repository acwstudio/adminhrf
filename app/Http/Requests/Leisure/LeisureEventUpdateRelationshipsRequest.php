<?php

namespace App\Http\Requests\Leisure;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LeisureEventUpdateRelationshipsRequest
 * @package App\Http\Requests\Leisure
 */
class LeisureEventUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:events,id',
            'data.*.type' => 'required|in:events',
        ];
    }
}
