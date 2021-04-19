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
            'data.attributes.yatextid' => 'string',
            'data.attributes.announce' => 'required|string',
            'data.attributes.body' => 'required|string',
            'data.attributes.show_in_rss' => 'required|boolean',
            'data.attributes.status' => 'required|boolean',
            'data.attributes.show_in_main' => 'required|boolean',
            'data.attributes.show_in_afisha' => 'required|boolean',
            'data.attributes.close_commentation' => 'required|boolean',
            'data.attributes.published_at' => 'required|string',

            'data.relationships.*' => 'present|array',
            'data.relationships.tags.data.*.type' => 'present|in:tags',
            'data.relationships.tags.data.*.id' => 'exists:tags,id',
            'data.relationships.images.data.*.type' => 'present|in:images',
            'data.relationships.images.data.*.id' => 'exists:images,id',
        ];
    }
}
