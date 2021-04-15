<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorImageUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Author;
use App\Models\Image;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorImageRelationshipsController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorImageRelationshipsController extends Controller
{
    /**
     * @param Author $author
     * @return AdminImagesIdentifierResource
     */
    public function index(Author $author)
    {
        return new AdminImagesIdentifierResource($author->image);
    }

    public function update(AuthorImageUpdateRelationshipsRequest $request, Author $author)
    {
        $ids = $request->input('data.*.id');

        $messages = [];

        foreach ($ids as $id) {

            $image = Image::find($id);
            $result = $this->handleRelationships($image, $id);

            if ($result['result']) {
                $author->image()->save($image);
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
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'author') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'author'
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
                if ($image->imageable_type !== 'author') {
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
