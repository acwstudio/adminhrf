<?php

namespace App\Http\Requests\Audiofile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AudiofileCreateRequest
 * @package App\Http\Requests\Audiofile
 */
class AudiofileCreateRequest extends FormRequest
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
//            'type' => 'required|in:audiofiles',
//            'file' => 'required|mimetypes:application/mp3'
            'audio' => 'required|mimes:mp3'
        ];
    }
}
