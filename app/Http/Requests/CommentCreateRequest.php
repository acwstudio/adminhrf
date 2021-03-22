<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
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
            'data.user_id' => 'required|integer',
            'data.text' => 'required|string',
            'data.commentable_id' => 'required|integer',
            'data.commentable_type' => 'required|string',
            'data.parent_id' => 'required|integer',
            'data.answer_to' => 'required|json',
            'data.liked' => 'required|integer',
            'data.children_count' => 'required|integer',
        ];
    }
}
