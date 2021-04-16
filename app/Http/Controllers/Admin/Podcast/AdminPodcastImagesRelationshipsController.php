<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Podcast\PodcastImagesRelationshipsUpdateRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Podcast\AdminPodcastResource;
use App\Models\Image;
use App\Models\Podcast;
use Illuminate\Http\Request;

/**
 * Class AdminPodcastImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastImagesRelationshipsController extends Controller
{
    /**
     * @param Podcast $podcast
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Podcast $podcast)
    {
        return AdminImagesIdentifierResource::collection($podcast->images);
    }

    /**
     * @param PodcastImagesRelationshipsUpdateRequest $request
     * @param Podcast $podcast
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PodcastImagesRelationshipsUpdateRequest $request, Podcast $podcast)
    {
        $ids = $request->input('data.*.id');

        $messages = [];

        foreach ($ids as $id) {

            $image = Image::find($id);
            $result = $this->handleRelationships($image, $id);

            if ($result['result']) {
                $podcast->images()->save($image);
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
     * @param Podcast $podcast
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'podcast') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'podcast'
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
                if ($image->imageable_type !== 'podcast') {
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

