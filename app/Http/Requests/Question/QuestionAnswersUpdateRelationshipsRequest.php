<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class QuestionAnswersUpdateRelationshipsRequest
 * @package App\Http\Requests\Question
 */
class QuestionAnswersUpdateRelationshipsRequest extends FormRequest
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
            'data.*.id' => 'required|integer|exists:tanswers,id',
            'data.*.type' => 'required|in:answers',
        ];
    }
}
