<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AnswerUpdateRequest
 * @package App\Http\Requests\Answer
 */
class AnswerUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:answers',
            'data.attributes' => 'required|array',
            'data.attributes.question_id' => 'integer',
            'data.attributes.title' => 'string',
            'data.attributes.is_right' => 'boolean',
            'data.attributes.description' => 'string',
            'data.attributes.points' => 'integer',

            'data.relationships.*' => 'present|array',
            'data.relationships.questions.data.*.type' => 'present|in:questions',
            'data.relationships.questions.data.*.id' => 'exists:questions,id',
        ];
    }
}
