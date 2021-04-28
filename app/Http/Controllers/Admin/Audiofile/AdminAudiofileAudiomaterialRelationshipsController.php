<?php

namespace App\Http\Controllers\Admin\Audiofile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiofile\AudiofileAudiomaterialUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialIdentifierResource;
use App\Models\Audiofile;
use Illuminate\Http\Request;

/**
 * Class AdminAudiofileAudiomaterialRelationshipsController
 * @package App\Http\Controllers\Admin\Audiofile
 */
class AdminAudiofileAudiomaterialRelationshipsController extends Controller
{
    /**
     * @param Audiofile $audiofile
     * @return AdminAudiomaterialIdentifierResource
     */
    public function index(Audiofile $audiofile)
    {
        return new AdminAudiomaterialIdentifierResource($audiofile->audiomaterial);
    }

    /**
     * @param AudiofileAudiomaterialUpdateRelationshipsRequest $request
     * @param Audiofile $audiofile
     */
    public function update(AudiofileAudiomaterialUpdateRelationshipsRequest $request,
                           Audiofile $audiofile)
    {
        $ids = $request->input('data.*.id');
        $audiofile->update([
            'audiomaterial_id' => $ids[0]
        ]);
    }
}
