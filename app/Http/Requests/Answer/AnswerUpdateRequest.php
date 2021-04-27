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
            'data.attributes.question_id' => 'sometimes|integer|exists:questions,id',
            'data.attributes.title' => 'sometimes|required|string',
            'data.attributes.is_right' => 'sometimes|required|boolean',
            'data.attributes.description' => 'sometimes|required|string',
            'data.attributes.points' => 'sometimes|required|integer',

//            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'integer|exists:images,id',
        ];
    }
}
