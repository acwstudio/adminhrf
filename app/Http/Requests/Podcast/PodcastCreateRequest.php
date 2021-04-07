<?php

namespace App\Http\Requests\Podcast;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PodcastCreateRequest
 * @package App\Http\Requests\Podcast
 */
class PodcastCreateRequest extends FormRequest
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
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.iframe' => 'required|string',
            'data.attributes.order' => 'required|integer',
            'data.attributes.viewed' => 'required|integer',
            'data.attributes.commented' => 'required|integer',
            'data.attributes.liked' => 'required|integer',
            'data.attributes.created_at' => 'sometimes|string',
            'data.attributes.updated_at' => 'sometimes|string',
        ];
    }
}
