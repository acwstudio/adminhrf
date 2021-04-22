<?php

namespace App\Http\Requests\DocumentCategory;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DocumentCategoryUpdateRequest
 * @package App\Http\Requests\DocumentCategory
 */
class DocumentCategoryUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:documentcategories',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
        ];
    }
}
