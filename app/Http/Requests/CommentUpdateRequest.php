<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
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
            'data.user_id' => 'integer',
            'data.text' => 'string',
            'data.commentable_id' => 'integer',
            'data.commentable_type' => 'string',
            'data.parent_id' => 'integer',
            'data.answer_to' => 'json',
            'data.liked' => 'integer',
            'data.children_count' => 'integer',
        ];
    }
}
