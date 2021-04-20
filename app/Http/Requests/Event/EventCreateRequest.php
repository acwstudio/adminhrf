<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EventCreateRequest
 * @package App\Http\Requests\Event
 */
class EventCreateRequest extends FormRequest
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
            'data.attributes.title' => 'required|string',
            'data.attributes.announce' => 'required|string',
            'data.attributes.body' => 'required|string',
            'data.attributes.street' => 'required|string',
            'data.attributes.afisha_date' => 'required|string',
            'data.attributes.published_at' => 'required|string',
            'data.attributes.city_id' => 'required|integer',
            'data.attributes.leisure_id' => 'required|integer',
            'data.attributes.link' => 'required|string',

            'data.relationships.*' => 'present|array',
            'data.relationships.images.data' => 'required|array',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
