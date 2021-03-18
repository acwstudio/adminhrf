<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUpdateRequest extends FormRequest
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
            'data.document_category_id' => 'integer',
            'data.title' => 'string',
            'data.announce' => 'string',
            'data.body' => 'string',
            'data.file' => 'string',
            'data.document_date' => 'string',
            'data.document_text_date' => 'string',
            'data.options' => 'json',
        ];
    }
}
