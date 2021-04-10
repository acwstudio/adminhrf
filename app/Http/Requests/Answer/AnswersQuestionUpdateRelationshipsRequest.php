<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AnswersQuestionUpdateRelationshipsRequest
 * @package App\Http\Requests\Answer
 */
class AnswersQuestionUpdateRelationshipsRequest extends FormRequest
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
            'data.*.type' => 'required|in:questions'
        ];
    }
}
