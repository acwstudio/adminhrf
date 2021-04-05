<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class QuestionCreateRequest
 * @package App\Http\Requests\Question
 */
class QuestionCreateRequest extends FormRequest
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
            'data.type' => 'required|in:questions',
            'data.attributes.text' => 'required|string',
            'data.attributes.type' => 'required|string',
            'data.attributes.position' => 'required|integer',
            'data.attributes.points' => 'required|integer',
            'data.attributes.has_points' => 'required|boolean',
        ];
    }
}
