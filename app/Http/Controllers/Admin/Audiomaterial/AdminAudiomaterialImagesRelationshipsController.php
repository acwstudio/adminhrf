<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Audiomaterial;
use App\Models\Image;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialImagesRelationshipsController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return AdminImagesIdentifierResource::collection($audiomaterial->images);
    }

    /**
     * @param AudiomaterialImagesUpdateRelationshipsRequest $request
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AudiomaterialImagesUpdateRelationshipsRequest $request, Audiomaterial $audiomaterial)
    {
        $ids = $request->input('data.*.id');

        $messages = [];

        foreach ($ids as $id) {

            $image = Image::find($id);
            $result = $this->handleRelationships($image, $id);

            if ($result['result']) {
                $audiomaterial->images()->save($image);
                array_push($messages, $result);
            } else {
                response();
                array_push($messages, $result);
            }

        }

        return response()->json($messages, 200);
    }

    /**
     * @param $image
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'audiomaterial') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'audiomaterial'
            ];

            return $message;

        } else {
            if (!$image) {
                $message = [
                    'id_image' => $image->id,
                    'result' => false,
                    'description' => 'Image ' . $id . ' is not exists'
                ];
            } else {
                if (!is_null($image->imageable_id)) {
                    $message = [
                        'id_image' => $image->id,
                        'result' => false,
                        'description' => 'Image ' . $id . ' already has ' . $image->imageable_type
                            . ' relation'
                    ];
                }
                if ($image->imageable_type !== 'audiomaterial') {
                    $message = [
                        'id_image' => $image->id,
                        'result' => false,
                        'description' => 'Image ' . $id . ' will be related to ' . $image->imageable_type
                    ];
                }
            }
            return $message;
        }

    }
}
