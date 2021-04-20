<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EventUpdateRequest
 * @package App\Http\Requests\Event
 */
class EventUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:events',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.announce' => 'string',
            'data.attributes.body' => 'string',
            'data.attributes.street' => 'string',
            'data.attributes.afisha_date' => 'string',
            'data.attributes.published_at' => 'string',
            'data.attributes.city_id' => 'integer',
            'data.attributes.leisure_id' => 'integer',
            'data.attributes.link' => 'string',

//            'data.relationships' => 'required|array',
            'data.relationships.*' => 'present|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
