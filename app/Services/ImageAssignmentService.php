<?php

declare(strict_types=1);


namespace App\Services;


use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageAssignmentService
 * @package App\Services
 */
class ImageAssignmentService
{
    /**
     * Create the Image relationship to Model
     * In fact updates the imageable_id field for images table
     *
     * @param Model $model
     * @param array $Ids
     * @param string $imageableType
     * @return \Illuminate\Http\JsonResponse
     */
    public function assign(Model $model, array $Ids, string $imageableType)
    {
        $messages = [];

        foreach ($Ids as $id) {

            $image = Image::find($id);
            $result = $this->checkRelationships($image, $imageableType, $model->id);

            if ($result['result']) {
                $model->images()->save($image);
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
     * @return array
     */
    private function checkRelationships($image, $imageableType, $modelId)
    {
        if (is_null($image->imageable_id)) {
            if ($image->imageable_type === $imageableType) {
                $message = [
                    'id_image' => $image->id,
                    'result' => true,
                    'description' => 'The image id = ' . $image->id . ' was related to the '
                        . $image->imageable_type . ' id = ' . $modelId
                ];
            } else {
                $message = [
                    'id_image' => $image->id,
                    'result' => false,
                    'description' => 'The image id = ' . $image->id . ' is for the '
                        . $image->imageable_type
                ];
            }
        } else {
            $message = [
                'id_image' => $image->id,
                'result' => false,
                'description' => 'The image id = ' . $image->id . ' is already related to the '
                    . $image->imageable_type . ' id = ' . $image->imageable_id
            ];
        }

        return $message;
    }

}
