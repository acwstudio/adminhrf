<?php

namespace App\Http\Requests\Comment;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CommentUpdateRequest
 * @package App\Http\Requests\Comment
 */
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
            'data' => 'required|array',
            'data.type' => 'required|in:comments',
            'data.attributes' => 'required|array',
            'data.attributes.text' => 'required|string',
            'data.attributes.status' => [
                'required',
                Rule::in(Comment::$statuses)
            ],
        ];
    }
}
