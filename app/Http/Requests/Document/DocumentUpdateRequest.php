<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DocumentUpdateRequest
 * @package App\Http\Requests\Document
 */
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
            'data' => 'required|array',
            'data.id' => 'string',
            'data.type' => 'required|in:documents',
            'data.attributes' => 'required|array',
            'data.attributes.document_category_id' => 'integer',
            'data.attributes.title' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.body' => 'string',
            'data.attributes.file' => 'string',
            'data.attributes.document_date' => 'string',
            'data.attributes.document_text_date' => 'string',
            'data.attributes.options' => 'json',

            'data.relationships.images.data' => 'required|array',
        ];
    }
}
