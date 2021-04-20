<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AuthorCreateRequest
 * @package App\Http\Requests\Author
 */
class AuthorCreateRequest extends FormRequest
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
            'data.type' => 'required|in:authors',
            'data.attributes.firstname' => 'required|string',
            'data.attributes.surname' => 'required|string',
            'data.attributes.patronymic' => 'required|string',
            'data.attributes.birth_date' => 'required|string',
            'data.attributes.announce' => 'required|string',
            'data.attributes.description' => 'required|string',

            'data.relationships.*' => 'present|array',
            'data.relationships.articles.data.*.type' => 'present|in:articles',
            'data.relationships.articles.data.*.id' => 'exists:articles,id',
            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
