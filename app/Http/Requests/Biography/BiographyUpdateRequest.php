<?php

namespace App\Http\Requests\Biography;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BiographyUpdateRequest
 * @package App\Http\Requests\Biography
 */
class BiographyUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:biographies',
            'data.attributes' => 'required|array',
            'data.attributes.surname' => 'string',
            'data.attributes.firstname' => 'string',
            'data.attributes.patronymic' => 'string',
            'data.attributes.birth_date' => 'string',
            'data.attributes.death_date' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.description' => 'string',
            'data.attributes.government_start' => 'nullable|integer',
            'data.attributes.government_end' => 'nullable|integer',
            'data.attributes.published_at' => 'string',
//            'data.attributes.viewed' => 'integer',
            'data.attributes.biblio' => 'json',
            'data.attributes.active' => 'boolean',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'integer|exists:tags,id',
            'data.relationships.biocategories.data.*.type' => 'present|in:biocategories',
            'data.relationships.biocategories.data.*.id' => 'integer|exists:biocategories,id',
            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'integer|exists:images,id',
        ];
    }
}
