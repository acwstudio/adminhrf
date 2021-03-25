<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DocumentCreateRequest
 * @package App\Http\Requests
 */
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
            'data' => 'required|array',
            'data.type' => 'required|in:documents',
            'data.attributes' => 'required|array',
            'data.attributes.document_category_id' => 'required|integer',
            'data.attributes.title' => 'required|string',
            'data.attributes.announce' => 'required|string',
            'data.attributes.body' => 'required|string',
            'data.attributes.file' => 'required|string',
            'data.attributes.document_date' => 'required|string',
            'data.attributes.document_text_date' => 'required|string',
            'data.attributes.options' => 'required|json',
        ];
    }
}
