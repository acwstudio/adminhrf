<?php

namespace App\Http\Requests\Podcast;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PodcastUpdateRequest
 * @package App\Http\Requests\Podcast
 */
class PodcastUpdateRequest extends FormRequest
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
            'data.type' => 'required|in:podcasts',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'string',
            'data.attributes.description' => 'sometimes|string',
            'data.attributes.iframe' => 'sometimes|string',
            'data.attributes.order' => 'sometimes|integer',
            'data.attributes.viewed' => 'sometimes|integer',
            'data.attributes.commented' => 'sometimes|integer',
            'data.attributes.liked' => 'sometimes|integer',
            'data.attributes.created_at' => 'sometimes|string',
            'data.attributes.updated_at' => 'sometimes|string',
        ];
    }
}
