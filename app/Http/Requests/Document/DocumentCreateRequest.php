<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DocumentCreateRequest
 * @package App\Http\Requests\Document
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
            'data.attributes.announce' => 'nullable|string',
            'data.attributes.body' => 'nullable|string',
            'data.attributes.file' => 'required|string',
            'data.attributes.document_date' => 'required|string',
            'data.attributes.document_text_date' => 'nullable|string',
            'data.attributes.options' => 'nullable|array',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'exists:tags,id',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
