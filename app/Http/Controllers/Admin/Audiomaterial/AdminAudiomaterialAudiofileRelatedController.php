<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Audiofile\AdminAudiofileResource;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialAudiofileRelatedController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialAudiofileRelatedController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return AdminAudiofileResource
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return new AdminAudiofileResource($audiomaterial->audiofile);
    }
}
