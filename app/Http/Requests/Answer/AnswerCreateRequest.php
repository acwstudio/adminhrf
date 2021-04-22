<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AnswerCreateRequest
 * @package App\Http\Requests\Answer
 */
class AnswerCreateRequest extends FormRequest
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
            'data.attributes.question_id' => 'required|integer|exists:questions,id',
            'data.attributes.title' => 'required|string',
            'data.attributes.is_right' => 'required|boolean',
            'data.attributes.description' => 'required|string',
            'data.attributes.points' => 'required|integer',
        ];
    }
}
