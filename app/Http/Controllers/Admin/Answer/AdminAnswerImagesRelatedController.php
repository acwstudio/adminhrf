<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\TAnswer;
use Illuminate\Http\Request;

/**
 * Class AdminAnswerImagesRelatedController
 * @package App\Http\Controllers\Admin\Answer
 */
class AdminAnswerImagesRelatedController extends Controller
{
    /**
     * @param TAnswer $answer
     * @return AdminImageCollection
     */
    public function index(TAnswer $answer)
    {
        return new AdminImageCollection($answer->images);
    }
}
