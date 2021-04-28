<?php

namespace App\Http\Controllers\Admin\Audiofile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialResource;
use App\Models\Audiofile;
use Illuminate\Http\Request;

/**
 * Class AdminAudiofileAudiomaterialRelatedController
 * @package App\Http\Controllers\Admin\Audiofile
 */
class AdminAudiofileAudiomaterialRelatedController extends Controller
{
    /**
     * @param Audiofile $audiofile
     * @return AdminAudiomaterialResource
     */
    public function index(Audiofile $audiofile)
    {
        return new AdminAudiomaterialResource($audiofile->audiomaterial);
    }
}
