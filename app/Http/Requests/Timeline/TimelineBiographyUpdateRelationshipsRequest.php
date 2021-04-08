<?php

namespace App\Http\Requests\Timeline;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TimelineBiographyUpdateRelationshipsRequest
 * @package App\Http\Requests\Timeline
 */
class TimelineBiographyUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer',
            'data.*.type' => 'required|in:biographies',
        ];
    }
}
