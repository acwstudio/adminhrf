<?php

namespace App\Http\Requests\Audiofile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AudiofileUpdateRequest
 * @package App\Http\Requests\Audiofile
 */
class AudiofileUpdateRequest extends FormRequest
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
            'audio' => 'required|mimes:mp3'
        ];
    }
}
