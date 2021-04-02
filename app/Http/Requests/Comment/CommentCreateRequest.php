<?php

namespace App\Http\Requests\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CommentCreateRequest
 * @package App\Http\Requests\Comment
 */
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
            'text' => 'required|string',
            'commentable_id' => 'required|integer',
            'commentable_type' => [
                'required',
                'string',
                function($attribute, $value, $fail) {
                    if(!array_key_exists($value, Relation::$morphMap)) {
                        $fail('Invalid '.$attribute.'='.$value);
                    }
                }
            ],
            'parent_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    if(is_null(Comment::find($value))) {
                        $fail('Comment with '.$attribute.'='.$value.' not found.');
                    }
                },
            ],
//                'answer_to' => 'sometimes',
            'answer_to.user_id' => 'nullable|integer|required_with:answer_to.comment_id',
            'answer_to.comment_id' => 'nullable|integer|required_with:answer_to.user_id',
        ];
    }
}
