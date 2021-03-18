<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentCreateRequest extends FormRequest
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
            'data.document_category_id' => 'required|integer',
            'data.title' => 'required|string',
            'data.announce' => 'required|string',
            'data.body' => 'required|string',
            'data.file' => 'required|string',
            'data.document_date' => 'required|string',
            'data.document_text_date' => 'required|string',
            'data.options' => 'required|json',
        ];
    }
}
