<?php

namespace App\Rules;

use App\Models\Image;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

/**
 * Class EqualImageableType
 * @package App\Rules
 */
class EqualImageableType implements Rule
{
    private $error;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $ids = request()->input('data.*.id');
        $data = request()->input('data');
//        $types = request()->input('data.*.type');

        $images = Image::find($ids);
        $mess = collect();
        foreach ($images as $key => $image) {
//            $image = Image::find($id);
//            if (!$image && $image->imageable_type === 'articles') {
//                $this->error = " - image {$id} doesn't exist";
//                return false;
//            }
//            $image = Image::find($id);

            if (!is_null($image)) {
                if ($image->imageable_type !== $data[$key]['imageable_type']) {

                    $text = [$attribute[1] => 'Image ' . $image->id . ' has ' . $image->imageable_type];
                    $mess->push($text);
//                    push($mess, $text);
//                    $status[] = false;
                    $this->error = $mess;
//                    $this->error = $text;
//                    return false;
                } else {
                    $this->error = '';
                }

//                return false;
            }
        }

        return $mess ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
//        return $this->error;
//        return "Error " . json_encode($this->error);
//        return "Error {$this->error}";
//        return 'The validation error message.';
        return ':attribute';

    }
}
