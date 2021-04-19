<?php

namespace App\Http\Requests\Timeline;

use App\Rules\ExistsInAnyTable;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TimelineTimelineableUpdateRelationshipsRequest
 * @package App\Http\Requests\Timeline
 */
class TimelineTimelineableUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => ['required', 'integer', new ExistsInAnyTable(['articles', 'biographies'])],
            'data.*.type' => 'required|in:articles,biographies',
        ];
    }
}
